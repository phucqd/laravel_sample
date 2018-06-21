<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'txtName' => 'required',
            'txtPrice' => 'required',
            'fImages' => 'image:jpg,jpeg,png'
        ];
    }

    public function messages(){
        return[
            'txtName.required' => 'Vui long nhap ten san pham',
            'txtPrice.required' => 'Vui long nhap gia san pham',
            'fImages.image' => 'File tai len khong dung dinh dang'
        ];
    }
}
