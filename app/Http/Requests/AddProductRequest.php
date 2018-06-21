<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'txtName' => 'required|unique:products,name',
            'txtPrice' => 'required',
            'fImages' => 'required|image:jpg,jpeg,png'
        ];
    }
    public function messages(){
        return[
            'txtName.required' => 'Vui long nhap ten san pham',
            'txtName.unique' => ' Ten san pham da ton tai',
            'txtPrice.required' => 'Vui long nhap gia san pham',
            'fImages.required' => 'Vui long chon anh cho san pham',
            'fImages.image' => 'File tai len khong dung dinh dang'
        ];
    }
}
