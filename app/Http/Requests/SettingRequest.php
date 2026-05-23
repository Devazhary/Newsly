<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'site_name' => 'string|max:255',
            'favicon' => 'nullable|image',
            'logo' => 'nullable|image',
            'facebook' => 'url',
            'instagram' => 'url',
            'twitter' => 'url',
            'youtube' => 'url',
            'country' => 'string|max:255',
            'city' => 'string|max:255',
            'street' => 'string|max:255',
            'email' => 'email',
            'phone' => 'string|max:20',
        ];
    }
}
