<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Response;
use App\Models\ProjectRoom;
use App\Transformers\front\AdditionTransform;
use App\Http\Requests\Api\front\StoreAddition;
use League\Fractal\Serializer\ArraySerializer;


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

        $addition = fractal($addition, new AdditionTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('store addition successfully'), 201);

    }
}
