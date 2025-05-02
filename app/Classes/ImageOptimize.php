<?php
namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
//use Intervention\Image\Laravel\Facades\Image;


class ImageOptimize extends GetImage
{
    public function cropImage($name)
    {
        $image = Image::read(Storage::disk('public')->get('tmp/'.$name));
        $croppedImage = $image->crop(
            width: 70,
            height: 70,
            position: 'center'
        );

        $croppedImage->save(Storage::disk('public')->path('images/'.$name));
    }
}
