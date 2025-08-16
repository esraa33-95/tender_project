<?php

namespace App\Http\Requests\Api\front;

use Illuminate\Foundation\Http\FormRequest;

class RateContractor extends FormRequest
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
            'project_id'=>'required|integer|exists:projects,id',
            'contractor_id'=>'required|integer|exists:users,id',
            'user_id'=>'required|exists:users,id',
            'rate'=>'required|integer|min:1|max:5',
        ];
    }
}
