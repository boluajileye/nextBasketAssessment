<?php

namespace App\Http\Requests\User;

use App\Domain\DTO\UserRequestDto;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            "email" => [
                'required', 'string', 'email', 'unique:users,email'
            ],
            "firstName" => [
                'required', 'string', 'min:6', 'max:255'
            ],
            "lastName" => [
                'required', 'string', 'min:6', 'max:255'
            ]
        ];
    }

    /**
     * Convert validated data to DTO
     * @return UserRequestDto
     */
    public function convertToDto()
    {
        return new UserRequestDto($this);
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email Address is required.',
            'email.string'    => 'Email Address must be a string.',
            'email.email'     => 'Email Address must be a valid email address',

            'firstName.required'     =>  'First Name is Required.',
            'firstName.string'      => 'First Name must be a string.',
            'firstName.min'        => 'First Name cannot be less than 6 characters.',
            'firstName.max'         => 'First Name cannot be more than 255 characters.',

            'lastName.required'     =>  'Last Name is Required.',
            'lastName.string'      => 'Last Name must be a string.',
            'lastName.min'        => 'Last Name cannot be less than 6 characters.',
            'lastName.max'         => 'Last Name cannot be more than 255 characters.'
        ];
    }
}
