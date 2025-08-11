<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\StoreRoomZone;
use App\Http\Requests\Api\front\UpdateRoomZone;
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

    return $this->responseApi(__('store room successfully'), $room, 201);
        
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomZone $request, string $id)
    {
        $data = $request->validated();

        $room = ProjectRoom::FindOrfail($id);

        $room->update($data);

         if ($request->hasFile('image'))
             {
              $room->addMedia($request->file('image'))
                       ->toMediaCollection('images');
             }

     $room = fractal($room, new RoomZoneTransform())
                  ->serializeWith(new ArraySerializer())
                  ->toArray();

    return $this->responseApi(__('messages.update_room'),$room);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
       $room = ProjectRoom::findOrfail($id);

       $room->delete();

    return  $this->responseApi(__('messages.delete_room'),204); 
    }
}
