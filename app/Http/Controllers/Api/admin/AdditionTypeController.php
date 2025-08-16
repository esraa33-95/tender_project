<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\Admin\AdditionTypeTransform;
use App\Models\AdditionType;
use App\Traits\Response;
use App\Http\Requests\Api\Admin\StoreAdditionType;
use App\Http\Requests\Api\admin\UpdateAdditionType;
use Illuminate\Support\Facades\DB;
use League\Fractal\Serializer\ArraySerializer;

class AdditionTypeController extends Controller
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

    $query = AdditionType::query();

      if ($search)
    {
        $query->whereTranslationLike('name', '%' . $search . '%', $locale);
    }

    $total = $query->count();

    $additiontype = $query->skip($skip ?? 0)->take($take ?? $total)->get();

    $additiontype =  fractal()->collection($additiontype)
                  ->transformWith(new AdditionTypeTransform())
                   ->serializeWith(new ArraySerializer())
                   ->toArray();

    return $this->responseApi('', $additiontype, 200, ['count' =>$total]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdditionType $request)
    {
        $addition_id = $request->input('addition_id');
        $price = $request->input('price');
        $contractor_percentage = $request->input('contractor_percentage');
        $added_date = $request->input('added_date');

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],

        'addition_id'=>$addition_id,
        'price'=>$price,
        'contractor_percentage'=>$contractor_percentage,
        'added_date'=>$added_date,
    ];

    $additiontype = AdditionType::create($data);

    $additiontype = fractal($additiontype, new AdditionTypeTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('messages.store_addition_type'),$additiontype, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $additiontype = AdditionType::findOrFail($id);

         $additiontype = fractal()
                         ->item($additiontype)
                         ->transformWith(new AdditionTypeTransform())
                         ->serializeWith(new ArraySerializer())
                         ->toArray();

        return  $this->responseApi('',$additiontype,200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdditionType $request, string $id)
    {
        $addition_id = $request->input('addition_id');
        $price = $request->input('price');
        $contractor_percentage = $request->input('contractor_percentage');
        $added_date = $request->input('added_date');

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],
        
        'addition_id'=>$addition_id,
        'price'=>$price,
        'contractor_percentage'=>$contractor_percentage,
        'added_date'=>$added_date,
        ];

         $additiontype = AdditionType::findOrFail($id);

         $additiontype->update($data);

        $additiontype = fractal($additiontype, new AdditionTypeTransform())
                  ->serializeWith(new ArraySerializer())
                  ->toArray();

    return $this->responseApi(__('messages.update_addition_type'), $additiontype);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
         $additiontype = AdditionType::findOrFail($id);

        $rooms = DB::table('addition_project_rooms')
                      ->where('addition_type_id', $id)
                      ->exists();

        if ($rooms) 
        {
        return $this->responseApi(__('messages.no_delete'), 403);
       }

        $additiontype->delete();
        
        return  $this->responseApi(__('messages.delete_additiontype'),204);
    }
}
