<?php

namespace App\Http\Requests\Web\Carts;

use App\Http\Requests\ValidateJsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class GetCartLocalStorage extends FormRequest
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
            'local_carts' => 'required|array',
            'local_carts.*.product_id' => 'required|numeric|min:1|max:50',
            'local_carts.*.size_id'    => 'required|numeric|min:1|max:50',
            'local_carts.*.color_id'   => 'required|numeric|min:1|max:50',
            'local_carts.*.quantity'   => 'required|numeric|min:1|max:50',
        ];

        return $rules;
    }
}
