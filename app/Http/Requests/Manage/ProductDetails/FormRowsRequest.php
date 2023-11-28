<?php

namespace App\Http\Requests\Manage\ProductDetails;

use App\Http\Requests\ValidateJsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class FormRowsRequest extends FormRequest
{
    use ValidateJsonResponse;

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
            'id'               => 'nullable',
            'product_id'       => 'integer|required',
            'rows.*.size_id' => 'required|numeric|min:1',
            'rows.*.color_id' => 'required|numeric|min:1',
            'rows.*.brand_id' => 'required|numeric|min:1',
            'rows.*.quantity' => 'required|numeric|min:1',
            'rows.*.disp'   => 'required|numeric|min:1'
        ];

        return $rules;

    }

}
