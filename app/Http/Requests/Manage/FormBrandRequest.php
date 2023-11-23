<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\ValidateJsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class FormBrandRequest extends FormRequest
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
        return [
            'id'        => 'integer|nullable',
            'name'      => 'string|required|max:255',
            'disp'      => 'integer|required|in:0,1'
        ];
    }
}
