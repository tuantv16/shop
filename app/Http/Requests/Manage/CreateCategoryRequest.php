<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\ValidateJsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'category_name'      => 'string|required|max:255',
            'prefix'      => 'string|required|max:30',
            'parent_id'         => 'integer|nullable|max:50',
            'level'          => 'integer|required',
            'disp'      => 'integer|nullable|in:0,1'
        ];
    }
}
