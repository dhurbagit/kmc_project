<?php

namespace App\Domains\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubSectorRequest extends FormRequest
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
            'sector_id' => 'required|exists:sectors,id',
            'name_en' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'sector_id.required' => 'The sector field is required.',
            'sector_id.exists' => 'The selected sector is invalid.',
            'name_en.required' => 'The English name field is required.',
            'name_en.string' => 'The English name must be a string.',
            'name_en.max' => 'The English name may not be greater than 255 characters.',
        ];
    }   
}
