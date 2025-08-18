<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\StoreBid;
use App\Models\Bid;
use App\Models\Project;
use App\Traits\Response;
use App\Transformers\front\BidTransform;
use League\Fractal\Serializer\ArraySerializer;
use Illuminate\Http\Request;

class BidController extends Controller
{
    use Response;
    //store bid
    public function store(StoreBid $request)
    {
      $data = $request->validated();

      $bid = Bid::create($data);

       $project = fractal($bid, new BidTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('messages.store_bid'));

    }


//accept bid or reject
public function changebids(Request $request, $id)
{
   $data = $request->validate([
        'status' => 'required|in:1,2',
    ]);

    $bid = Bid::with('project')
               ->findOrFail($id);

    if ($data['status'] == Bid::ACCEPTED) 
        { 
          $bid->update([
              'status' =>Bid::ACCEPTED,
           ]);
        
        $bid->project()->update([
                'contractor_id'=>$bid->contractor_id,
                'status' => Project::RUNNING,
          ]);


        Bid::where('project_id', $bid->project_id)
                       ->where('id', '!=', $bid->id)
                        ->update(['status' => Bid::REJECTED]);

        return $this->responseApi(__('messages.accept_bid'), 200);

    } elseif($data['status'] == Bid::REJECTED)  
    { 
        $bid->update([
              'status' => Bid::REJECTED,
        ]);

        return $this->responseApi(__('messages.reject_bid'), $bid, 200);
    }

}








}







