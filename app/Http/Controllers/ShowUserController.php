<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class ShowUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ShowUserRequest $request, UserService $service, $id)
    {
        $user = $service->getUser($id);

        return (new UserResource($user))->hide(['registration_timestamp']);
    }
}
