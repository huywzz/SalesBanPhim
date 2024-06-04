<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'gender' => [Rule::in(['Nam', 'Nữ'])],
            'email' => ['required', 'email', 'string', 'unique:App\Models\User,email'],
            'password' => ['required','string'],
            'address' => ['required','string'],
        ];
    }
}
