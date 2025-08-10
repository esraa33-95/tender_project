<?php

namespace App\Http\Requests\Api\front;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterial extends FormRequest
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
            'material_category_id'=>'required|integer|exists:material_categories,id',
            'room_zone_id'=>'required|integer|exists:room_zones,id',

        ];
    }
}
