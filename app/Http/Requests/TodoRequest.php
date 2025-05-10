<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodoRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($this->filled('due_at')) {
            $this->merge([
                'due_at' => str_replace('T', ' ', $this->input('due_at')),
            ]);
        }

        if ($this->filled('reminder_at')) {
            $this->merge([
                'reminder_at' => str_replace('T', ' ', $this->input('reminder_at')),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'due_at' => [
                'nullable',
                Rule::date()->format('Y-m-d H:i'),
            ],
            'reminder_at' => [
                'nullable',
                Rule::date()->format('Y-m-d H:i'),
            ],
            'is_completed' => ['nullable', 'boolean'],
        ];
    }
}
