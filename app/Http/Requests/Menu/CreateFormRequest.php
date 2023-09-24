<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
//            |min:20',
            'content' => 'required'
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Vui lòng nhập tên danh mục',
            'description.required' => 'Vui lòng nhập mô tả',
//            'description.min' => 'Mô tả nhập ít nhất 20 kí tự',
            'content.required' => 'Nhập mô tả chi tiết cho danh mục '
        ];
    }
}
