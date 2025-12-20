<?php

namespace App\Domains\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KpiSnapshotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
            'program_id'    => ['nullable', 'integer', 'exists:programs,id'],
            'indicator_id'  => ['nullable', 'integer', 'exists:indicators,id'],

            'snapshot_date' => ['required', 'date'],

            'value' => ['nullable', 'numeric'],

            'progress_percent' => ['required', 'integer', 'min:0', 'max:100'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if (
                empty($this->input('department_id')) &&
                empty($this->input('program_id')) &&
                empty($this->input('indicator_id'))
            ) {
                $validator->errors()->add(
                    'department_id',
                    'Select at least one: Department, Program, or Indicator.'
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'department_id.exists' => 'The selected department is invalid.',
            'program_id.exists'    => 'The selected program is invalid.',
            'indicator_id.exists'  => 'The selected indicator is invalid.',

            'snapshot_date.required' => 'The snapshot date field is required.',
            'snapshot_date.date'     => 'The snapshot date must be a valid date.',

            'value.numeric' => 'The value must be a numeric value.',

            'progress_percent.required' => 'The progress percent field is required.',
            'progress_percent.integer'  => 'The progress percent must be an integer.',
            'progress_percent.min'      => 'The progress percent cannot be less than 0.',
            'progress_percent.max'      => 'The progress percent cannot exceed 100.',
        ];
    }
}
