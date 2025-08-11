<?php

namespace App\Transformers\front;

use App\Models\RoomZone;
use League\Fractal\TransformerAbstract;

class MaterialTransform extends TransformerAbstract
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
    public function transform(RoomZone $room):array
    {
        return [
            'id'=>$room->id,
            'name_en'=>$room->translate('en')->name,
            'name_ar'=>$room->translate('ar')->name,
            'type'=>$room->type,

      'materials' => $room->materials ? $room->materials->map(function ($material) {
               return [
       
        'name_ar' => $material->translate('ar')->name,
        'name_en' => $material->translate('en')->name,
        'price'=>$material->price,
        'room_property'=>$material->room_property,
        'hint'=>$material->hint,
                  ];
           }) : null,
        ];
    }
}