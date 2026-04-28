<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3'],
            'username' => ['required', 'unique:users,username', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone', 'string', 'min:10'],
            'image' => ['nullable', 'image'],
            'country' => ['required', 'string', 'min:4', 'max:30'],
            'city' => ['required', 'string', 'min:4', 'max:30'],
            'street' => ['required', 'string', 'min:5', 'max:50'],
            'status' => ['in:0,1'],
            'email_verified_at' => ['in:0,1'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
        ];
    }
}
