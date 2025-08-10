<?php

namespace App\Http\Requests\Api\admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AdditionTranslation;

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
            'name_en' => ['required','string','min:2','max:255','regex:/^[a-zA-Z ]*$/',
            function ($attribute, $value, $error) {
                if (AdditionTranslation::where('name', $value)->where('locale', 'en')->exists()) 
                {
                    $error(__('validation.custom.name_en.unique'));
                }
            }
        ],
        'name_ar' => ['required','string','min:2','max:255', 'regex:/^[\p{Arabic} ]+$/u',
            function ($attribute, $value, $error) {
                if (AdditionTranslation::where('name', $value)->where('locale', 'ar')->exists())
                 {
                    $error(__('validation.custom.name_ar.unique'));
                }
            }
        ],
        'room_zone_id' => 'required|exists:room_zones,id',
        'added_date'=>'required|date_format:Y-m-d',
        
        ];
    }
}
