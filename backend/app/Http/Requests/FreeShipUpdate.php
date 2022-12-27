<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreeShipUpdate extends FormRequest
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
            'minimum_spent' => ['required', 'numeric', 'min:0'],
            'remark' => ["not_regex:/!|<|>|'|\*|\"/i", 'required'],
            'valid_date' => ['required', 'before:expired_at'],
            'expired_at' => ['required', 'after_or_equal:valid_date'],
        ];
    }
}
