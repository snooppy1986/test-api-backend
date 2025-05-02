<?php

namespace Database\Factories;

use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\FakePeople;
use App\Classes\ImageOptimize;

use App\Jobs\OptimizeImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use function Tinify\fromFile;
use function Tinify\fromUrl;
use function Tinify\setKey;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->firstName();
        $email = strtolower($name).'.'.strtolower(fake()->lastName()).'@example.com';
        $time = fake()->dateTimeBetween('-1 year', '-1 day')->getTimestamp();

        $templatePath = storage_path("app/public/tmp/");
        $imagePath = fake()->image(dir: $templatePath, category: 'animals', fullPath: true);

        $path = storage_path("app/public/images/");
        $fileName = Str::random(35);
        $ext = 'jpg';
        OptimizeImage::dispatch($imagePath, $path, $fileName, $ext);

        //Clean tmp directory
        if(File::exists($imagePath)){
            File::delete($imagePath);
            echo 'File delete Successful'.PHP_EOL;
        }else{
            echo 'File not found'.PHP_EOL;
        }

        return [
            'name' => $name,
            'email' => $email,
            'phone' => fake('uk_UA')->e164PhoneNumber(),
            'position_id' => fake()->numberBetween(1, 10),
            'registration_timestamp' => $time,
            'photo' => $fileName.'.'.$ext
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

}
