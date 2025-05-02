<?php

use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Spatie\Image\Enums\CropPosition;

Route::get('/', function () {
    return view('welcome');
});

Route::any('{url}', function(){
    return response(content: ['success' => false, 'message' => 'Page not found'], status: 404);
})->where('url', '.*');
