<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            // 'email' => 'required|string|email|max:100',
            // 'gender' => 'required|string',
            // "image"=>"required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            'user_type' => 'required|string',
            // 'location' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
            // 'phone_number' => 'required|string|min:11|max:11|unique:users',
            'phone_number' => 'required|string',
        ];
    }
}
