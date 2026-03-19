<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'max:60'],
            'username' => ['required', 'min:2', 'max:60', Rule::unique('users', 'username')->ignore(auth('web')->user()->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth('web')->user()->id)],
            'phone' => ['required', 'numeric', Rule::unique('users', 'phone')->ignore(auth('web')->user()->id)],
            'image' => ['nullable', 'mimes:png,jpg', 'image'],
            'country' => ['required', 'min:2', 'max:40'],
            'city' => ['required', 'min:2', 'max:40'],
            'street' => ['required', 'min:2', 'max:40'],
        ];
    }
}
