<?php

namespace App\Transformers\admin;

use League\Fractal\TransformerAbstract;
use App\Models\AdditionType;

class AdditionTypeTransform extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(AdditionType $type):array
    {
        return [
              'id' =>$type->id,
              'name_en' => $type->translate('en')->name,
              'name_ar' => $type->translate('ar')->name,
              'addition_id'=>$type->addition_id,
              'price'=>$type->price ?? 'n/a',
              'contractor_percentage'=>$type->contractor_percentage ?? 'n/a' ,
              'added_date'=>$type->added_date ?? 'n/a',
        ];
    }
}
