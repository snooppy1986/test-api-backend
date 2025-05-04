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

    public function refreshToken($id)
    {
        $token = Token::query()->updateOrCreate(
            [
                'id' => $id
            ],
            [
                'token' => Str::random(32),
                'is_used' => false
            ]
        );
        /*$token = Token::query()->first();
        if($token){
            $token->update([
                'token' => Str::random(32),
                'is_used' => false
            ]);
            $token->refresh();
        }else{
            $token = Token::query()->create([

            ]);
        }*/

        return $token;
    }
}
