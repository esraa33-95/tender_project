<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\StoreMaterial;
use App\Models\RoomZone;
use Illuminate\Http\Request;
use App\Traits\Response;
use App\Transformers\front\MaterialTransform;
use App\Transformers\front\RoomZoneTransform;
use League\Fractal\Serializer\ArraySerializer;

class MaterialController extends Controller
{
    use Response;
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterial $request , string $id)
    {
        $data = $request->validated();

       $roomzone = RoomZone::findOrfail($id);

       $roomzone->materials()->attach($data);

        $materialroom = fractal($roomzone, new MaterialTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('store material successfully'), $materialroom, 201);

    }

    

    

    

    
}