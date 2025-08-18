<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\Admin\ProjectTypeTransform;
use App\Models\ProjectType;
use App\Traits\Response;
use App\Http\Requests\Api\Admin\StoreProjectType;
use App\Http\Requests\Api\admin\UpdateProjectType;
use League\Fractal\Serializer\ArraySerializer;

class ProjectTypeController extends Controller
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

    $query = ProjectType::query();

      if ($search)
    {
        $query->whereTranslationLike('name', '%' . $search . '%', $locale);
    }

    $total = $query->count();

    $types = $query->skip($skip ?? 0)->take($take ?? $total)->get();

     $types =  fractal()->collection($types)
                  ->transformWith(new ProjectTypeTransform())
                   ->serializeWith(new ArraySerializer())
                   ->toArray();

    return $this->responseApi('', $types, 200, ['count' =>$total]);
}

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectType $request)
    {
         $date = $request->input('added_date');

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],

        'added_date'=>$date,
    ];

    $type = ProjectType::create($data);

    $type = fractal($type, new ProjectTypeTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('messages.store_type'), $type, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $type = ProjectType::findOrFail($id);

         $type = fractal()
                 ->item($type)
                 ->transformWith(new ProjectTypeTransform())
                 ->serializeWith(new ArraySerializer())
                 ->toArray();

        return  $this->responseApi('',$type,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectType $request, string $id)
    {
         $date = $request->input('added_date');

        $data = [
        'en' => ['name' => $request->name_en],
        'ar' => ['name' => $request->name_ar],
        'added_date'=>$date,
    ];

    $type = ProjectType::findOrFail($id);

    $type->update($data);

    $type = fractal($type, new ProjectTypeTransform())
                  ->serializeWith(new ArraySerializer())
                  ->toArray();

    return $this->responseApi(__('messages.update_type'), $type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
         $type = ProjectType::with('projects')
                             ->findOrFail($id);

         if($type)
        {
            return  $this->responseApi(__('messages.no_delete_type'),403); 
        }
        $type->delete();
        
        return  $this->responseApi(__('messages.delete_type'),204); 
    }
}
