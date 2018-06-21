<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'txt_ten_kh' => 'required',
            'txt_sdt_kh' => 'required|unique:customer,phone_number',
            'txt_dia_chi_kh' => 'required'
        ];
    }

    public function messages(){
        return [
            'txt_ten_kh.required' => 'Vui lòng nhập họ tên quý khách',
            'txt_sdt_kh.required' => 'Vui lòng thêm số điện thoại',
            'txt_sdt_kh.unique'   => 'Ai đó đã đăng ký số điện thoại quý khách vừa nhập',
            'txt_dia_chi_kh.required'   => 'Vui lòng thêm địa chỉ giao hàng'
        ];
    }
}
