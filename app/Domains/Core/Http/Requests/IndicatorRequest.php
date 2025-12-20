<?php

namespace App\Domains\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndicatorRequest extends FormRequest
{
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
            'source_type' => 'required|in:SDG,ISO37120,ISO37122,SCI',
            'code' => 'required|string|max:255|unique:indicators,code',
            'short_name' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'source_type.required' => 'The source type field is required.',
            'source_type.in' => 'The selected source type is invalid.',
            'code.required' => 'The indicator code field is required.',
            'code.unique' => 'The indicator code has already been taken.',
            'short_name.required' => 'The short name field is required.',
            'short_name.string' => 'The short name must be a string.',
            'short_name.max' => 'The short name may not be greater than 255 characters.',
        ];
    }   
}
