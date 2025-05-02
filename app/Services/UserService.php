<?php
namespace App\Services;

use App\Exceptions\ItemNotFoundException;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserService
{
    public function usersListWithPagination($count)
    {
        $data = User::query()->orderBy('id')->paginate($count)->appends(['count' => $count]);

        if(!count($data->items())){
            throw new ItemNotFoundException("Page not found", 404);
        }

        return $data;
    }

    public function getUser($id)
    {
        $user = User::query()->find($id);

        if(!$user){
            throw new ItemNotFoundException("User not found", 404);
        }

        return $user;
    }

    public function createUser($data)
    {
        $data['registration_timestamp'] = time();

        if(User::query()
            ->where('email', $data['email'])
            ->orWhere('phone', $data['phone'])
            ->first())
        {
            throw new HttpResponseException(response([
                    "success" => false,
                    "message" => "User with this email or phone already exist."
                ],
                409,
                ['Content-Type'=>'application/json']));
        }

        return User::query()->create($data)->id;
    }
}
