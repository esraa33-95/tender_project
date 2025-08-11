<?php

namespace App\Transformers\front;

use League\Fractal\TransformerAbstract;
use App\Models\ProjectRoom;

class AdditionTransform extends TransformerAbstract
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
    public function transform(ProjectRoom $room): array
    {
        return [
            'id'     => $room->id,
            'name_en'=> $room->translate('en')->name ?? '',
            'name_ar'=> $room->translate('ar')->name ?? '',
            'length' => $room->length,
            'width'  => $room->width,
            'height' => $room->height,
            
           
            'additions' => $room->additions->map(function ($addition) {
                return [
                    'id'      => $addition->id,
                    'name_en' => $addition->translate('en')->name,
                    'name_ar' => $addition->translate('ar')->name,
                    'price'   => $addition->price,
                    'amount'  => $addition->pivot->amount,
                ];
            }),
        ];
    }
}
