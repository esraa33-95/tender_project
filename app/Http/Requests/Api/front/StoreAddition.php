<?php

namespace App\Http\Requests\Api\front;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddition extends FormRequest
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
            'project_room_id'=>'required|integer|exists:project_rooms,id',
            'addition_type_id'=>'required|integer|exists:addition_types,id',
            'amount'=>'required|integer',
        ];
    }
}
