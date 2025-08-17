<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Traits\Response;
use App\Models\ProjectRoom;
use App\Http\Requests\Api\front\StoreAddition;
use App\Events\ProjectCostUpdated;


class AdditionController extends Controller
{
    use Response;

    public function store(StoreAddition $request , string $id)
{
    $data = $request->validated();

    $projectRoom = ProjectRoom::findOrFail($id);

    foreach ($data['additions'] as $addition) 
      {
        $projectRoom->additionTypes()->attach(
          
            $addition['addition_type_id'], 
            ['amount' => $addition['amount']]
        );
    }

    $projectId = $projectRoom->project_id;

    event(new ProjectCostUpdated($projectId));

    return $this->responseApi(__('messages.store_addition'));
}




}
