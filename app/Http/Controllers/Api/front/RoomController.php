<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\StoreRoomZone;
use App\Models\ProjectRoom;
use App\Traits\Response;
use App\Transformers\front\RoomTransform;

use League\Fractal\Serializer\ArraySerializer;

class RoomController extends Controller
{
    use Response;
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomZone $request)
    {
        $data = $request->validated();

        $room = ProjectRoom::create($data);

         if ($request->hasFile('image'))
             {
              $room->addMedia($request->file('image'))
                       ->toMediaCollection('images');
             }

        $room = fractal($room, new RoomTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('messages.store_project_room'), $room, 201);
        
    }

    
    

    


}
