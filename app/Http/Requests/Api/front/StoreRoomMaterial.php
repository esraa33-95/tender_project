<?php

namespace App\Http\Requests\Api\front;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomMaterial extends FormRequest
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
            'materials' => 'required|array',
            'materials.floor' => 'required|exists:material_categories,id',
            'materials.ceil' => 'required|exists:material_categories,id',
            'materials.wall' => 'required|exists:material_categories,id',
        ];
    }
}
