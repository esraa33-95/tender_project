<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\admin\StoreMaterialCategory;
use App\Http\Requests\Api\admin\UpdateMaterialCategory;
use App\Models\MaterialCategory;
use App\Traits\Response;
use App\Transformers\admin\MaterialCategoryTransform;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;


class MaterialController extends Controller
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

    $query = MaterialCategory::query();

      if ($search)
    {
        $query->whereTranslationLike('name', '%' . $search . '%', $locale);
    }

    $total = $query->count();

    $materials = $query->skip($skip ?? 0)->take($take ?? $total)->get();

    $materials =  fractal()->collection($materials)
                  ->transformWith(new MaterialCategoryTransform())
                   ->serializeWith(new ArraySerializer())
                   ->toArray();

    return $this->responseApi('', $materials, 200, ['count' =>$total]);
}
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialCategory $request)
    {
        $room_property = $request->input('room_property');
        $price = $request->input('price');
        $contractor_percentage = $request->input('contractor_percentage');
        $added_date = $request->input('added_date');

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],

        'room_property'=>$room_property,
        'price'=>$price,
        'contractor_percentage'=>$contractor_percentage,
        'added_date'=>$added_date,
    ];

    $material = MaterialCategory::create($data);

    if ($request->hasFile('image')) {
        $material->addMedia($request->file('image'))
                ->toMediaCollection('images');
    }

    $material = fractal($material, new MaterialCategoryTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('messages.store_material '),$material, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $material = MaterialCategory::findOrFail($id);

         $material = fractal()
                 ->item($material)
                 ->transformWith(new MaterialCategoryTransform())
                 ->serializeWith(new ArraySerializer())
                 ->toArray();

        return  $this->responseApi('',$material,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialCategory $request, string $id)
    {
        $room_property = $request->input('room_property');
        $price = $request->input('price');
        $contractor_percentage = $request->input('contractor_percentage');
        $added_date = $request->input('added_date');

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],

        'room_property'=>$room_property,
        'price'=>$price,
        'contractor_percentage'=>$contractor_percentage,
        'added_date'=>$added_date,
    ];

    $material = MaterialCategory::findOrFail($id);

    $material->update($data);

    if ($request->hasFile('image' )) 
        {
            $material->clearMediaCollection('images');

            $material->addMedia($request->file('image'))
                       ->toMediaCollection('images');
        }

    $material = fractal($material, new MaterialCategoryTransform())
                  ->serializeWith(new ArraySerializer())
                  ->toArray();

    return $this->responseApi(__('messages.update_material'), $material);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
         $material = MaterialCategory::with('roomzones')
                                      ->findOrFail($id);

         if($material)
        {
            return  $this->responseApi(__('messages.no_delete_material'),403); 
        }

        $material->delete();
        
        return  $this->responseApi(__('messages.delete_material'),204);
    }
}
