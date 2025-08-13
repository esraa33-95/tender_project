<?php

namespace App\Transformers\front;

use League\Fractal\TransformerAbstract;
use App\Models\RoomZone;

class RoomZoneTransform extends TransformerAbstract
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
        ];
    }
}
