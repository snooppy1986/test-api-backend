<?php

namespace App\Http\Requests;

use App\Rules\EmailRule;
use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required', 'min:2', 'max:60'],
            "email" => ['required','min:6', 'max:100', new EmailRule()],
            "phone" => ['required', new PhoneRule()],
            "position_id" => ['required', 'integer', 'min:1'],
            "photo" => ['required', 'mimes:jpg,jpeg', 'max:5120', 'dimensions:min_width=70,min_height=70']
        ];
    }
}
