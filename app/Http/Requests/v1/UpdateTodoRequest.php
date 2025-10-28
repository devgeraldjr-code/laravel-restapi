<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        
            $method = $this->method();
            if($method == 'PUT')
            {
                return [
                    'userId' => ['required','exists:users,id'],
                    'title' => ['required', 'string', 'max:255'],
                    'description' => ['nullable', 'string'],
                    'isCompleted' => ['required', 'boolean'],
                    'startDate' => ['required','date'],
                    'dueDate' => ['required', 'date', 'after_or_equal:start_date']
                ];
            }
            else {
                return [
                    'userId' => ['sometimes','exists:users,id'],
                    'title' => ['sometimes', 'string', 'max:255'],
                    'description' => ['nullable', 'string'],
                    'isCompleted' => ['sometimes', 'boolean'],
                    'startDate' => ['sometimes','date'],
                    'dueDate' => ['sometimes', 'date', 'after_or_equal:start_date']
                ];
            }
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->userID,
            'is_completed' => $this->isCompleted,
            'start_date' => $this->startDate,
            'due_date' => $this->dueDate,

        ]);
    }
}
