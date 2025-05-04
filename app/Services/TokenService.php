<?php


namespace App\Services;


use App\Models\Token;
use Illuminate\Support\Str;

class TokenService
{
    public function getToken()
    {
        return Token::query()->first();
    }

    public function updateIsUsed(): void
    {
        Token::query()->update([
            'is_used' => true
        ]);
    }

    public function refreshToken()
    {
        $token = Token::query()->first();
        $token
            ? $token ->update([
                'token' => Str::random(32),
                'is_used' => false
            ])
            : Token::query()->create([
                'token' => Str::random(32),
                'is_used' => false
                ]);
        $token->refresh();
        return $token;
    }
}
