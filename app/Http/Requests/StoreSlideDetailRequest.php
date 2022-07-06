<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlideDetailRequest extends FormRequest
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
            'description'=>'required|min:50',
            'picture'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được bỏ trống',
            'min'=>':attribute quá ngắn, ít nhất :min ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'description'=>'Mô tả slide',
            'picture'=>'Hình ảnh'
        ];
    }
}
