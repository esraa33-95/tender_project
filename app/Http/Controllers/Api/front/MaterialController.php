<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Models\RoomMaterial;
use App\Models\ProjectRoom;
use App\Models\MaterialCategory;
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

     $area = $projectRoom->length * $projectRoom->width;

    foreach ($request->materials as $type => $materialId) 
        {
            $material = MaterialCategory::findOrFail($materialId);

           $price_material = $material->price * $area * (1 + ($material->contractor_percentage / 100));

            RoomMaterial::create([
                'project_room_id' => $Id,
                'material_type' => $type,
                'material_category_id' => $materialId,
                'area'=>$area,
                'price'=>$price_material,
            ]);
        }

    return $this->responseApi(__('material store successfully'));
}




   


}


    

    

    

    
