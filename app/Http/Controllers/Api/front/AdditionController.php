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


class AdditionController extends Controller
{
    use Response;

    public function store(StoreAddition $request , string $id)
    {
      $data = $request->validated();

      $projectroom = ProjectRoom::findOrFail($id);

    $addition =  $projectroom->additions()->attach( 
                                 $data['addition_id'], 
                                 ['amount' => $data['amount']]
                               );

        $projectId = $projectroom->project_id;

       event(new ProjectCostUpdated($projectId));

    return $this->responseApi(__('store addition successfully'), 201);

    }
}
