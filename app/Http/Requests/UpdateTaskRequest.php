<?php

namespace App\Http\Requests;


class UpdateTaskRequest extends ApiRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',

            'status' => 'sometimes|in:Pending,In Progress,Completed',

            'priority' => 'sometimes|in:Low,Medium,High',

            'due_date' => 'nullable|date'
        ];
    
    }
}
