<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Response;
use App\Models\ProjectRoom;
use App\Transformers\front\AdditionTransform;
use App\Http\Requests\Api\front\StoreAddition;
use League\Fractal\Serializer\ArraySerializer;
use App\Events\ProjectCostUpdated;
use App\Models\Project;

class AdditionController extends Controller
{
    use Response;

    public function store(StoreAddition $request , string $id)
    {
      $data = $request->validated();

      $projectroom = ProjectRoom::findOrFail($id);


       $projectroom->additionTypes()->attach(
                     $data['addition_type_id'], 
                     ['amount' => $data['amount']]
                  );

        $projectId = $projectroom->project_id;

       event(new ProjectCostUpdated($projectId));

      $project = Project::find($projectId);

    return $this->responseApi(__('store addition successfully'));

//        $message = null;

//     if ($project->total_cost > $project->budget_to) 
//       {
//         $message = "exceeded";
//       }
 
//     return $this->responseApi(__('store addition successfully'),  
//     ['total_cost' => $project->total_cost], 201, 
//     ['message' => $message] 
// );


     }
}
