<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\ValidateJsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class FormProductRequest extends FormRequest
{
    use ValidateJsonResponse;

    protected $maxSize = 1024; // Kích thước tối đa trong KB (1 MB)
    protected $maxWidth = 800;
    protected $maxHeight = 1200;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'id'                => 'nullable',
            'category_id'       => 'integer|required',
            'brand_id'          => 'integer|required',
            'product_name'      => 'string|nullable|max:255',
            'description'       => 'string|nullable|max:500',
            'price'             => 'string|numeric|between:1,99999999999999',
            'disp'              => 'integer|nullable|in:0,1',
            'is_image_deleted'  => 'string'
        ];

        if ($this->hasFile('image')) {
            $rules['image'] = [
                'file',
                "max:{$this->maxSize}",
                "dimensions:max_width={$this->maxWidth},max_height={$this->maxHeight}",
                'mimes:jpg,jpeg,png,gif',
            ];
        }

        return $rules;

    }

    public function messages()
    {
        return [
            'image.max' => 'Hinh anh dang vuot qua dung luong cho phep',
            'image.dimensions' => "Kich thuoc cua hinh anh vuot qua tieu chuan cho phep max_width={$this->maxWidth},max_height={$this->maxHeight}",
            'image.mimes' => 'Loại hinh anh khong duoc ho tro. Chi chap nhan dinh dang: jpg, jpeg, png, gif',
        ];

    }
}
