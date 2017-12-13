<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == 'POST') {
            return [
                'title' => 'required|alpha_num|max:50',
                'price' => 'required|numeric',
                'inventory' => 'required',
                'images' => 'required|mimes:jpeg,png,bmp',
                'description' => 'required',
            ];
        }

        return [
            'title' => 'required|alpha_num|max:50',
            'price' => 'required|numeric',
            'inventory' => 'required',
            'description' => 'required',
        ];
    }
}
