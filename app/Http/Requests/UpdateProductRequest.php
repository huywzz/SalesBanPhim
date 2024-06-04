<?php

namespace App\Http\Requests;

use App\Models\categories;
use App\Models\Manufacture;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name'=>['required','string'],
            'description'=>['string'],
            'specs'=>['string','nullable'],
            'price'=>['required'],
            'status',
            'quantity' => ['numeric'],
            'manufacture_id'=>['required',Rule::exists(Manufacture::class,'id')],
            'manufactures_name',
            'categories_id'=>['required',Rule::exists(categories::class,'id')],
            'categories_name',
        ];
    }
}
