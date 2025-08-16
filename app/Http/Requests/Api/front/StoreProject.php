<?php

namespace App\Http\Requests\Api\front;

use Illuminate\Foundation\Http\FormRequest;

class StoreProject extends FormRequest
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
             'user_id' => 'required|exists:users,id',
             'contractor_id' => 'required|exists:users,id',
            'project_type_id' => 'required|exists:project_types,id',
            'name'=>'required|min:2|max:50',
            'area'=>'required|min:0.01',
            'budget_from' => 'required|numeric|min:0.01',
            'budget_to' => 'required|numeric|gt:budget_from',
            'open_budget'=>'nullable|boolean',
            'location'=>'required|min:2|max:100',
            'duration'=>'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'start_date' => 'required|date_format:Y-m-d|after:today',
            'status' => 'required|integer|in:1',
            'added_date'=>'nullable|date_format:y-m-d',
           
        ];
    }
}
