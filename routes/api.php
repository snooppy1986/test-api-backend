<?php

use App\Http\Controllers\GetTokenController;
use App\Http\Controllers\RefreshTokenController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\PositionsListController;
use App\Http\Controllers\ShowUserController;
use App\Http\Controllers\UsersListController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function (){
    Route::get('/', UsersListController::class);
    Route::post('/', CreateUserController::class)
        ->middleware(EnsureTokenIsValid::class);
    Route::get('/{id}/', ShowUserController::class);
});

Route::get('positions', PositionsListController::class);

Route::get('get-token', GetTokenController::class);
Route::get('token', RefreshTokenController::class);
