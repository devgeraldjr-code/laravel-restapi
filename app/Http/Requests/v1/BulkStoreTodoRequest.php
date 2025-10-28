<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreTodoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            '*.user_id'     => ['required', 'integer', 'exists:users,id'],
            '*.title'       => ['required', 'string', 'max:255'],
            '*.description' => ['nullable', 'string'],
            '*.is_completed'=> ['required', 'boolean'],
            '*.start_date'  => ['required', 'date'],
            '*.due_date'    => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $object) {
            $data[] = [
                'user_id'      => $object['userId']       ?? null,
                'title'        => $object['title']        ?? null,
                'description'  => $object['description']  ?? null,
                'is_completed' => $object['isCompleted']  ?? null,
                'start_date'   => $object['startDate']    ?? null,
                'due_date'     => $object['dueDate']      ?? null,
            ];
        }

        // replace entire input with transformed version
        $this->replace($data);
    }
}
