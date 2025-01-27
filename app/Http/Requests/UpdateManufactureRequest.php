<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManufactureRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:50',
                'min:2'
            ],
            'address' => [
                'required',
                'string',
                'max:50',
                'min:2'
            ],
            'phone' => [
                'required',
                'numeric',
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                'min:2'
            ],
        ];
    }
}
