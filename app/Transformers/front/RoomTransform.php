<?php

namespace App\Transformers\front;

use App\Models\ProjectRoom;
use League\Fractal\TransformerAbstract;

class RoomTransform extends TransformerAbstract
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
    public function transform(ProjectRoom $room):array
    {
        return [
            'id' => $room->id,
            'project_id' => $room->project_id,
            'room_zone_id' => $room->room_zone_id,
            'image' => $room->getFirstMediaUrl('images') ?: asset('storage/1.png'),
            'length'=>$room->length,
            'width'=>$room->width,
            'height'=>$room->height,
            'description'=>$room->description,
        ];
    }
}
