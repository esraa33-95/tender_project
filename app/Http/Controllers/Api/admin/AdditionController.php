<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addition;
use App\Traits\Response;
use App\Transformers\Admin\AdditionTransform;
use App\Http\Requests\Api\Admin\StoreAddition;
use App\Http\Requests\Api\admin\UpdateAddition;
use League\Fractal\Serializer\ArraySerializer;


class AdditionController extends Controller
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

    $query = Addition::query();

      if ($search)
    {
        $query->whereTranslationLike('name', '%' . $search . '%', $locale);
    }

    $total = $query->count();

    $additions = $query->skip($skip ?? 0)->take($take ?? $total)->get();

    $additions =  fractal()->collection($additions)
                  ->transformWith(new AdditionTransform())
                   ->serializeWith(new ArraySerializer())
                   ->toArray();

    return $this->responseApi('', $additions, 200, ['count' =>$total]);
}

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddition $request)
    {
         $date = $request->input('added_date');
         $room_zone = $request->input('room_zone_id');
         

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],

        'added_date'=>$date,
        'room_zone_id'=>$room_zone,
           
    ];

    $addition = Addition::create($data);

    $addition = fractal($addition, new AdditionTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('store addition successfully'),$addition, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $addition = Addition::findOrFail($id);

         $addition = fractal()
                         ->item($addition)
                         ->transformWith(new AdditionTransform())
                         ->serializeWith(new ArraySerializer())
                         ->toArray();

        return  $this->responseApi('',$addition,200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddition $request, string $id)
    {
        $date = $request->input('added_date');
         $room_zone = $request->input('room_zone_id');
        

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],

        'added_date'=>$date,
        'room_zone_id'=>$room_zone,
        
    ];
         $addition = Addition::findOrFail($id);

         $addition->update($data);

         $addition = fractal($addition, new AdditionTransform())
                  ->serializeWith(new ArraySerializer())
                  ->toArray();

    return $this->responseApi(__('messages.update_addition'), $addition);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
         $addition = Addition::with('additiontypes')
                                       ->findOrFail($id);

         if($addition)
        {
            return  $this->responseApi(__('messages.no_delete'),403); 
        }

        $addition->delete();
        
        return  $this->responseApi(__('messages.delete_addition'),204);
    }


}
