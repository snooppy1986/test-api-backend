<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;

class ShowMoreUsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $skipValue = $request->page == 1 ? 0 : ($request->page - 1) * $request->count;

        return new UserCollection(User::query()->skip($skipValue)->take(6)->get());
    }
}
