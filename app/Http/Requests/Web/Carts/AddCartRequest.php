<?php

namespace App\Http\Requests\Web\Carts;

use App\Http\Requests\ValidateJsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class AddCartRequest extends FormRequest
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
            'products' => 'required|array',
            'products.*.product_id' => 'required|numeric|min:1|max:50',
            'products.*.size_id'    => 'required|numeric|min:1|max:50',
            'products.*.color_id'   => 'required|numeric|min:1|max:50',
            'products.*.quantity'   => 'required|numeric|min:1|max:50',
        ];

        return $rules;
    }
}
