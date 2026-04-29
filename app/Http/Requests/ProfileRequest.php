<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'commentable' => ['in:on,off,0,1'],
            'status' => ['nullable', 'in:0,1'],
            'category_id' => ['exists:categories,id'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ];

        if ($this->isMethod('post')) {
            $rules['images'] = ['required'];
        } else {
            $rules['images'] = ['nullable'];
        }

        return $rules;
    }
}
