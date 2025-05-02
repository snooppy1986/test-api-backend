<?php

namespace App\Http\Controllers;

use App\Exceptions\ItemNotFoundException;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Services\UserService;

class UsersListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PaginateRequest $request, UserService $service)
    {
        $users = $service->usersListWithPagination($request->count ?? 6);

        return new UserCollection($users);
    }
}
