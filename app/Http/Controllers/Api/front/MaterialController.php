<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Models\RoomMaterial;
use App\Models\ProjectRoom;
use Illuminate\Http\Request;
use App\Traits\Response;
use League\Fractal\Serializer\ArraySerializer;

class MaterialController extends Controller
{
    use Response;
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $Id)
{
    $projectRoom = ProjectRoom::findOrFail($Id);

    $projectRoom->materials()->delete();

    foreach ($request->materials as $type => $materialId) {
            RoomMaterial::create([
                'project_room_id' => $Id,
                'material_type' => $type,
                'material_category_id' => $materialId
            ]);
        }

    return $this->responseApi(__('material store successfully'));
}

   


}


    

    

    

    
