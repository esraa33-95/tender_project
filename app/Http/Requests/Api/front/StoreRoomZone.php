<?php

namespace App\Http\Requests\Api\front;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\RoomZoneTranslation;

class StoreRoomZone extends FormRequest
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
           'room_zone_id'=>'required|exists:room_zones,id',
           'project_id'=>'required|exists:projects,id',
           'length'=>'required|numeric',
           'height'=>'required|numeric',
           'width'=>'required|numeric',
           'description'=>'required|string|min:2|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ];
    }
}
