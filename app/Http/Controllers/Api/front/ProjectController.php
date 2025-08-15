<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\StoreProject;
use App\Http\Requests\Api\front\CancelProject;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Traits\Response;
use App\Transformers\front\ProjectTransform;
use App\Transformers\front\ContractorTransform;
use App\Transformers\front\PendingProjectTransform;
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
        // $data['status'] = Project::PENDING;

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
                      ->where('status',Project::PENDING)
                       //->where('user_id',$user->id())
                       ->firstOrFail();

 $project->update([
    'status'=>Project::NEW,
 ]);

 $project = fractal()
            ->item($project) 
            ->transformWith(new ProjectTransform())
            ->serializeWith(new ArraySerializer())
            ->toArray();

      return $this->responseApi(__('project submit successfully'),$project,200);
} 

    //show all offers 
public function bids(string $id)
{
    $projectbids = Project::with('bids')
                           ->where('id',$id)
                           ->firstOrFail();


    $projectbids = fractal()
        ->item($projectbids)
        ->transformWith(new ProjectTransform())
        ->serializeWith(new ArraySerializer())
        ->toArray();

    return $this->responseApi('', $projectbids, 200);

}

//view contractor contacts
public function contact(string $id)
{
   $project = Project::with(['contractor', 'bids'])
                       ->findOrFail($id);

    if ($project->status !== Project::CONFIRMED ) 
        {
        return $this->responseApi('no contractor assigned to this project');
       }                       

    $project = fractal()
                 ->item($project)
                 ->transformWith(new ProjectTransform())
                 ->serializeWith(new ArraySerializer())
                 ->toArray();

    return $this->responseApi('', $project, 200);         
}

//contractor changeproject to running
public function changeproject(string $id)
{
   // $user = auth()->user();

    $project = Project::where('id', $id)
                     // ->where('user_id', auth()->id())
                     ->where('status', Project::CONFIRMED)
                      ->firstOrFail();

    $project->update([
           'status'=>Project::RUNNING,
    ]);

    $project = fractal()
            ->item($project) 
            ->transformWith(new ProjectTransform())
            ->serializeWith(new ArraySerializer())
            ->toArray();

return $this->responseApi(__('running project now  successfully'));
    
}


//complete project
public function complete(string $id)
{
   // $user = auth()->user();

    $project = Project::where('id', $id)
                     // ->where('user_id', auth()->id())
                     ->where('status', Project::RUNNING)
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

//cancel project
public function cancel(CancelProject $request,string $id)
{
//  $user = auth()->user();

  $data = $request->validated();

  $project =  Project::where('id',$id)
                    ->whereIn('status', [Project::NEW, Project::CONFIRMED, Project::RUNNING])
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
                 ->transformWith(new PendingProjectTransform())
                 ->serializeWith(new ArraySerializer())
                 ->toArray();

        return  $this->responseApi('',$pendingproject,200);
}

//pending projects
public function pendingprojects(Request $request)
{
     $take = $request->input('take');
     $skip = $request->input('skip');
   
    $query = Project::where('status', Project::PENDING);
 
    $total = $query->count();

    $projects = $query->skip($skip ?? 0)->take($take ?? $total)->get();

    $projects = fractal()->collection($projects)
               ->transformWith(new PendingProjectTransform())
               ->serializeWith(new ArraySerializer())
               ->toArray();

    return $this->responseApi('', $projects, 200, ['count' => $total]); 
}

    
}
