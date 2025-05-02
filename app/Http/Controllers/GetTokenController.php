<?php

namespace App\Http\Controllers;

use App\Http\Resources\TokenResource;
use App\Models\Token;
use App\Services\TokenService;
use Illuminate\Http\Request;

class GetTokenController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TokenService $service)
    {
        $token = $service->getToken();
        return new TokenResource($token);
    }
}
