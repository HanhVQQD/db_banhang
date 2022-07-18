<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProducts extends FormRequest
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
            'inputName'=>'required|max:300|string',
            'inputPrice'=>'required|numeric|min:5',
            'inputPromotionPrice'=>'required|numeric|min:1',
            'inputUnit'=>'string',
            'inputNew'=>'numeric',
            'inputType'=>'required|string',
            'inputImage'=>'required|filled|image|mimes:jpeg,png,jpg,gif,svg|max:25000',
        ];
    }

    public function messages()
    {
        return [
            'inputName.required'=>'Bạn chưa nhập tên phòng',
            'inputName.max'=>'Tên phòng chỉ có tối đa 300 ký tự',
            'roomDescription.required'=>'Bạn chưa nhập mô tả phòng',
            'inputPrice.required'=>'Bạn chưa nhập giá',
            'inputPrice.min'=>'Giá thuê phòng phải lớn hơn 1đ',
            'inputPromotionPrice.required'=>'Bạn chưa nhập giá',
            'inputPromotionPrice.min'=>'Giá thuê phòng phải lớn hơn 1đ',
            'inputType'=>'required|string',
            'inputImage.required'=>'Bạn chưa chọn ảnh',
            'inputImage.filled'=>'Bạn chưa chọn ảnh',
            'inputImage.max'=>'Kích thước ảnh tối đa là 25Mb',
            'inputImage.image'=>'File bạn upload không phải ảnh'
        ];
    } 
}
