<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Models\AdditionType;
use App\Models\MaterialCategory;
use App\Models\ProjectType;
use App\Traits\Response;
use App\Transformers\front\AdditionTypeTransform;
use App\Transformers\front\MaterialCategoryTransform;
use App\Transformers\front\ProjectTypeTransform;
use League\Fractal\Serializer\ArraySerializer;
use Illuminate\Http\Request;

class ListController extends Controller
{
     use Response;
 

//list of project types
public function projecttypes(Request $request)
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

    $projecttypes = $query->skip($skip ?? 0)->take($take ?? $total)->get();

    $projecttypes =  fractal()->collection($projecttypes)
                  ->transformWith(new ProjectTypeTransform())
                  ->serializeWith(new ArraySerializer())
                   ->toArray();

    return $this->responseApi('',$projecttypes,200,['count' => $total]);

    }


//list of materials category
public function materials(Request $request)
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

    return $this->responseApi('',$materials,200,['count' => $total]);

    }

//list of additions types
public function additiontypes(Request $request)
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

     $additions = $query->skip($skip ?? 0)->take($take ?? $total)->get();

     $additions =  fractal()->collection($additions)
                  ->transformWith(new AdditionTypeTransform())
                  ->serializeWith(new ArraySerializer())
                   ->toArray();

    return $this->responseApi('',$additions,200,['count' => $total]);

    }


//list of new projects
public function projects(Request $request)
{
     $take = $request->input('take');
     $skip = $request->input('skip');
   
    $query = Project::where('status', Project::NEW);
 
    $total = $query->count();

    $projects = $query->skip($skip ?? 0)->take($take ?? $total)->get();

    $projects = fractal()->collection($projects)
               ->transformWith(new PendingProjectTransform())
               ->serializeWith(new ArraySerializer())
               ->toArray();

    return $this->responseApi('', $projects, 200, ['count' => $total]); 
}








}
