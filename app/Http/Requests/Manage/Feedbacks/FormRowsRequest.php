<?php

namespace App\Http\Requests\Manage\Feedbacks;

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
            'id'             => 'nullable',
            'survey_id'       => 'integer|required',
            'rows.*.name'   => 'required|string|max:255',
            'rows.*.disp'    => 'nullable|numeric|in:1,0'
        ];

        return $rules;

    }

}
