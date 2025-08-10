<?php

namespace App\Http\Requests\Api\admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AdditionTypeTranslation;

class UpdateAdditionType extends FormRequest
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
          $id = $this->addition_type; 

    return [
        'name_en' => [ 'nullable','string','min:2','max:255','regex:/^[a-zA-Z ]*$/',
            function ($attribute, $value, $error) use ($id) {
                $exists = AdditionTypeTranslation::where('name', $value)
                    ->where('locale', 'en')
                    ->where('addition_type_id', '!=', $id)
                    ->exists();

                if ($exists) {
                    $error(__('validation.custom.name_en.unique'));
                }
            }
        ],
        'name_ar' => [ 'nullable','string','min:2','max:255', 'regex:/^[\p{Arabic} ]+$/u',
            function ($attribute, $value, $error) use ($id) {
                $exists = AdditionTypeTranslation::where('name', $value)
                    ->where('locale', 'ar')
                    ->where('addition_type_id', '!=', $id)
                    ->exists();

                if ($exists) {
                    $error(__('validation.custom.name_ar.unique'));
                }
            }
        ],
       
        'addition_id'=>['nullable','exists:additions,id'],
        'price'=>['nullable','numeric'],
        'contractor_percentage' => ['nullable', 'numeric','between:0,100'],
        'added_date'=>'nullable|date_format:Y-m-d',
    ];
    }
}
