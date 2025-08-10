<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\Admin\RoomTransform;
use App\Models\RoomZone;
use App\Traits\Response;
use App\Http\Requests\Api\Admin\StoreRoom;
use App\Http\Requests\Api\admin\UpdateRoom;
use League\Fractal\Serializer\ArraySerializer;

class RoomController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     */
      public function index(Request $request)
{
    $search = $request->input('search');
    $take = $request->input('take'); 
    $skip = $request->input('skip');  
    $locale = $request->query('lang', app()->getLocale());

    $query = RoomZone::query();

      if ($search)
    {
        $query->whereTranslationLike('name', '%' . $search . '%', $locale);
    }

    $total = $query->count();

    $rooms = $query->skip($skip ?? 0)->take($take ?? $total)->get();

     $rooms =  fractal()->collection($rooms)
                  ->transformWith(new RoomTransform())
                   ->serializeWith(new ArraySerializer())
                   ->toArray();

    return $this->responseApi('', $rooms, 200, ['count' =>$total]);
}

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoom $request)
    {
        $date = $request->input('added_date');
        $type = $request->input('type');

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],

        'added_date'=>$date,
        'type'=>$type,
    ];

    $room = RoomZone::create($data);

    $room = fractal($room, new RoomTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('store room successfully'), $room, 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = RoomZone::findOrFail($id);

         $room = fractal()
                 ->item($room)
                 ->transformWith(new RoomTransform())
                 ->serializeWith(new ArraySerializer())
                 ->toArray();

        return  $this->responseApi('',$room,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoom $request, string $id)
    {
       $date = $request->input('added_date');
        $type = $request->input('type');

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],

        'added_date'=>$date,
        'type'=>$type,
    ];

    $room = RoomZone::findOrFail($id);

    $room->update($data);

    $room = fractal($room, new RoomTransform())
                  ->serializeWith(new ArraySerializer())
                  ->toArray();

    return $this->responseApi(__('messages.update_room'),$room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
       $room = RoomZone::with('projectRooms')
                         ->findOrFail($id);
  
       if ($room) 
        {
        return $this->responseApi(__('messages.cannot_delete_roomzone'), 409);
    }
        $room->delete();
        
        return  $this->responseApi(__('messages.delete_roomzone'),204); 
    }
}
