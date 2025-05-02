<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Token;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::raw('SET time_zone=\'+00:00\'');
        //Clear images
        Storage::disk('public')->deleteDirectory('/images');
        Storage::disk('public')->deleteDirectory('/tmp');
        //Create directory to image
        Storage::disk('public')->makeDirectory('/images');
        Storage::disk('public')->makeDirectory('/tmp');

        //Create positions
        Position::factory(10)->create();
        //Create users
        User::factory(43)->create();

        //Create token
        Token::factory(1)->create();
    }
}
