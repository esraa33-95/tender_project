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

        $total_price = 0;

    foreach ($request->materials as $type => $materialId) 
        {
            $material = MaterialCategory::findOrFail($materialId);

             if ($type === 'floor' || $type === 'ceil') 
                {
            $area = $projectRoom->length * $projectRoom->width;

        } elseif ($type === 'wall') 
        {
            $area = 2 * ($projectRoom->length + $projectRoom->width) * $projectRoom->height;
        } 

          $price = $material->price * $area;

          $price_material = $price + ($price * $material->contractor_percentage / 100);

            RoomMaterial::create([
                'project_room_id' => $Id,
                'material_type' => $type,
                'material_category_id' => $materialId,
                'area'=>$area,
                'price'=>$price_material,
                
            ]);
         
           $total_price += $price_material;
    }

    $projectRoom->update([
        'total_price' => $total_price
    ]);

    return $this->responseApi(__('messages.store_material'), [
        'total_price' => $total_price
    ]);
}




   


}


    

    

    

    
