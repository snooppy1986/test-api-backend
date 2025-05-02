<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Services\ImageService;
use App\Services\TokenService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class CreateUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        CreateUserRequest $request,
        UserService $userService,
        TokenService $tokenService,
        ImageService $imageService
    )
    {
        $data = $request->validated();

        $imageName = $imageService->optimizeAndSaveImage($data['photo']);

        $data['photo'] = $imageName;

        $user = $userService->createUser($data);

        $tokenService->updateIsUsed();

        return response([
            'success' => true,
            'user_id' => $user,
            'message' => "New user successfully registered"
            ],
            201,
            ['Content-Type'=>'application/json']
        );
    }
}
