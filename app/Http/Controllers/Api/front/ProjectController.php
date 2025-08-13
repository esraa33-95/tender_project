<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\StoreProject;
use App\Http\Requests\Api\front\CancelProject;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Traits\Response;
use App\Transformers\front\ProjectTransform;
use League\Fractal\Serializer\ArraySerializer;

class ProjectController extends Controller
{
    use Response;
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProject $request )
    {
        $data = $request->validated();

      $project = Project::create($data);

     if ($request->hasFile('image'))
             {
              $project->addMedia($request->file('image'))
                       ->toMediaCollection('images');
             }

        $project = fractal($project, new ProjectTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('store project successfully'));
    }

//submit project
public function submit(string $id)
{
//$user = $auth()->user();

$project =  Project::where('id',$id)
                      ->where('status',Project::NEW)
                       //->where('user_id',$user->id())
                       ->firstOrFail();

 $project->update([
    'status'=>Project::CONFIRMED,
 ]);

 $project = fractal()
            ->item($project) 
            ->transformWith(new ProjectTransform())
            ->serializeWith(new ArraySerializer())
            ->toArray();

      return $this->responseApi(__('project submit successfully'),$project,200);
}  

//cancel project
public function cancel(CancelProject $request,string $id)
{
//  $user = auth()->user();

  $data = $request->validated();

  $project =  Project::where('id',$id)
                    ->whereIn('status', [Project::NEW, Project::CONFIRMED])
                    // ->where('user_id',$user->id())
                      ->firstOrFail();

 $project->update([
    'status'=>Project::CANCELLED,
    'cancel_reason'=>$data['cancel_reason'],
 ]);

  $project = fractal()
            ->item($project) 
            ->transformWith(new ProjectTransform())
            ->serializeWith(new ArraySerializer())
            ->toArray();

return $this->responseApi(__('cancel project successfully'), $project ,200);

}


//filter project(current,history)
public function index(Request $request)
{
    $take = $request->input('take');
    $skip = $request->input('skip');
    $search = $request->input('search'); 

    $query = Project::query();
 
    if ($search === 'current') 
        {
        $query->whereIn('status', [project::NEW, Project::CONFIRMED,Project::RUNNING]);
        } 
    elseif ($search === 'history') 
        {
        $query->whereIn('status', [Project::CANCELLED, Project::COMPLETED]);
        }

    $total = $query->count();

    $projects = $query->skip($skip ?? 0)->take($take ?? $total)->get();

    $projects = fractal()->collection($projects)
               ->transformWith(new ProjectTransform())
               ->serializeWith(new ArraySerializer())
               ->toArray();

    return $this->responseApi('', $projects, 200, ['count' => $total]);
}

//show details of project
public function show(string $id)
{
  //  $user = $auth()->user();

   $project = Project::where('id',$id)
                      // ->where('user_id',$user->id())
                       ->firstOrFail();
   
    $project = fractal()
                 ->item($project)
                 ->transformWith(new ProjectTransform())
                 ->serializeWith(new ArraySerializer())
                 ->toArray();

        return  $this->responseApi('',$project,200);
}

//complete project
public function complete(string $id)
{
   // $user = auth()->user();

    $project = Project::where('id', $id)
                     // ->where('user_id', auth()->id())
                      ->where('status',Project::RUNNING)
                      ->firstOrFail();

    $project->update([
           'status'=>Project::COMPLETED,
    ]);

    $project = fractal()
            ->item($project) 
            ->transformWith(new ProjectTransform())
            ->serializeWith(new ArraySerializer())
            ->toArray();

return $this->responseApi(__('completed project successfully'));
    
}

//pending projects
public function pendingprojects(Request $request)
{
     $take = $request->input('take');
     $skip = $request->input('skip');
   
    $query = Project::where('status',Project::PENDING);
 
    $total = $query->count();

    $projects = $query->skip($skip ?? 0)->take($take ?? $total)->get();

    $projects = fractal()->collection($projects)
               ->transformWith(new ProjectTransform())
               ->serializeWith(new ArraySerializer())
               ->toArray();

    return $this->responseApi('', $projects, 200, ['count' => $total]); 
}

//show pending projects
public function showpending(string $id)
{
  //  $user = $auth()->user();

   $pendingproject = Project::where('id',$id)
                      ->where('status',Project::PENDING)
                      // ->where('user_id',$user->id())
                       ->firstOrFail();
   
    $pendingproject = fractal()
                 ->item($pendingproject)
                 ->transformWith(new ProjectTransform())
                 ->serializeWith(new ArraySerializer())
                 ->toArray();

        return  $this->responseApi('',$pendingproject,200);
}



    
}
