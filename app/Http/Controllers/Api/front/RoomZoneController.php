<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\front\UpdateRoomZoneRequest;
use App\Models\RoomZone;
use App\Traits\Response;
use App\Transformers\front\RoomZoneTransform;
use League\Fractal\Serializer\ArraySerializer;

class RoomZoneController extends Controller
{
    use Response;
    
     public function update(UpdateRoomZoneRequest $request, string $id)
    {
       $date = $request->input('added_date');
        $type = $request->input('type');

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],

        'added_date'=>$date,
        'type'=>$type,
    ];

    $roomzone = RoomZone::findOrFail($id);

    $roomzone->update($data);

    $roomzone = fractal($roomzone, new RoomZoneTransform())
                  ->serializeWith(new ArraySerializer())
                  ->toArray();

    return $this->responseApi(__('messages.update_roomzone'),$roomzone);
    }


//delete
public function delete(string $id)
    {
       $roomzone = RoomZone::with(['projectRooms','additions','materials'])
                             ->findOrFail($id);
  
       if ($roomzone) 
        {
        return $this->responseApi(__('messages.cannot_delete_roomzone'), 409);
    }
        $roomzone->delete();
        
        return  $this->responseApi(__('messages.delete_roomzone'),204); 
    }    



}
