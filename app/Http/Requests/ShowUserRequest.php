<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShowUserRequest extends FormRequest
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
            'userId' => "integer"
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), ['userId' => $this->route()->parameters()['id']]);
    }

    public function messages(): array
    {
        return [
            'userId.integer' => 'The :attribute must be an integer.'
        ];
    }

    public function attributes()
    {
        return [
            'userId' => 'user ID'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(
            [
                'success' => false,
                'messages' => 'The user with the requested id does not exist.',
                'fails' => $validator->errors()
            ],
            400
        ));
    }
}
