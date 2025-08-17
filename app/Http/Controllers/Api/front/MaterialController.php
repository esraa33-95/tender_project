<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\StoreRoomMaterial;
use App\Models\RoomMaterial;
use App\Models\ProjectRoom;
use App\Models\MaterialCategory;
use App\Traits\Response;


class MaterialController extends Controller
{
    use Response;
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomMaterial $request, string $id)
{
    $data = $request->validated();

    $projectRoom = ProjectRoom::findOrFail($id);

    $total_price = 0;

    foreach ($request->materials as $type => $material_id) 
        {
            $material = MaterialCategory::findOrFail($material_id);

             if ($type === 'floor') 
                {
            $area = $projectRoom->length * $projectRoom->width;

        } elseif ($type === 'wall') 
        {
            $area = 2 * ($projectRoom->length + $projectRoom->width) * $projectRoom->height;

        }elseif($type === 'ceil') 
        {
             $area = $projectRoom->length * $projectRoom->width; 
        }

          $price = $material->price * $area;

          $contractor_percentage = $price * ($material->contractor_percentage /100) ;

          $price_material = $price + $contractor_percentage;

            RoomMaterial::create([
                'project_room_id' => $id,
                'material_type' => $type,
                'material_category_id' => $material_id,
                'area'=>$area,
                'price'=>$price_material,
                
            ]);
         
           $total_price += $price_material;
    }
    $projectRoom->update([
        'total_price' => $total_price
    ]);

    return $this->responseApi(__('messages.store_material'),[
        'total_price' => $total_price
    ]);
}



//show hint for price of each material
public function show(string $id)
    {
        $material = MaterialCategory::findOrFail($id);

        $contractor_percentage = $material->price * $material->contractor_percentage / 100;
        
        $hint_price = $contractor_percentage + $material->price;

        return $this->responseApi(__('information about  material'), 
        [
            'name' => $material->name,
            'hint_price' => $hint_price,
        ]);
    }



}


    

    

    

    
