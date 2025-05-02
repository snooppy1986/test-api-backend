<?php


namespace App\Services;


use App\Classes\File;
use App\Jobs\OptimizeImage;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;


class ImageService
{
    public function optimizeAndSaveImage($file): string
    {
        $path = storage_path("app/public/images/");
        $fileName = time().'_'.explode(separator: '.', string: $file->getClientOriginalName())[0];
        $fileExt = explode(separator: '.', string: $file->getClientOriginalName())[1];

        OptimizeImage::dispatch($file, $path, $fileName, $fileExt);

        return $fileName.'.'.$fileExt;
    }
}
