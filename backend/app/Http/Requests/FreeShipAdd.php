<?php

namespace App\Http\Requests;

use App\Models\Province;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FreeShipAdd extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'province.*' => ['required', Rule::exists(Province::class, 'province_name')],
            'remark.*' => ['required'],
            'min_spent.*' => ['required', 'min:0' ,'numeric'],
            'valid.*' => ['required'],
            'experied.*' => ['required', 'after_or_equal:valid.*'],     
        ];
    }
}
