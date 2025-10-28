<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreTodoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'userId'        => ['required', 'exists:users,id'],
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'isCompleted'   => ['required', 'boolean'],
            'startDate'     => ['required','date'],
            'dueDate'       => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id'       => $this->userId,
            'is_completed'  => $this->isCompleted,
            'start_date'    => $this->startDate,
            'due_date'      => $this->dueDate,

        ]);
    }
}
