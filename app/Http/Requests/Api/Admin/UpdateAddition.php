<?php

namespace App\Http\Requests\Api\admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AdditionTranslation;

class UpdateAddition extends FormRequest
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
         $id = $this->addition; 

    return [
        'name_en' => [ 'nullable','string','min:2','max:255','regex:/^[a-zA-Z ]*$/',
            function ($attribute, $value, $error) use ($id) {
                $exists = AdditionTranslation::where('name', $value)
                    ->where('locale', 'en')
                    ->where('addition_id', '!=', $id)
                    ->exists();

                if ($exists) {
                    $error(__('validation.custom.name_en.unique'));
                }
            }
        ],
        'name_ar' => [ 'nullable','string','min:2','max:255', 'regex:/^[\p{Arabic} ]+$/u',
            function ($attribute, $value, $error) use ($id) {
                $exists = AdditionTranslation::where('name', $value)
                    ->where('locale', 'ar')
                    ->where('addition_id', '!=', $id)
                    ->exists();

                if ($exists) {
                    $error(__('validation.custom.name_ar.unique'));
                }
            }
        ],
       
        'room_zone_id' => 'nullable|exists:room_zones,id',
        'added_date'=>'nullable|date_format:Y-m-d',
    ];
    }
}
