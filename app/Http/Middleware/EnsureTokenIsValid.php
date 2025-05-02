<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = Token::query()->first();

        if($token->token !== $request->header('token') || $token->is_used || $token->updated_at < Carbon::now()->subMinutes(40)){
            return response()->json([
                'success' => false,
                'message' => 'The token expired'
            ], 401);
        }

        return $next($request);
    }
}
