<?php

namespace App\Task\Http\CreateTask;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
}
