<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\StoreBid;
use App\Models\Bid;
use App\Models\Project;
use App\Traits\Response;
use App\Transformers\front\BidTransform;
use App\Transformers\front\ProjectTransform;
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

    return $this->responseApi(__('store bid successfully'));

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

//accept bid or reject
public function changebids(Request $request, $bidId)
{
   $data = $request->validate([
        'accept' => 'required|in:1,0',
    ]);

    $bid = Bid::with('project')
               ->findOrFail($bidId);


    if ($data['accept'] == 1) 
        { 
          $bid->update([
              'is_accepted' => true,
           ]);
        
        $bid->project()->update([
               // 'contractor_id' => $bid->contractor_id,
                'status' => Project::CONFIRMED,
            ]);


    $otherbids =  Bid::where('project_id', $bid->project_id)
            ->where('id', '!=', $bid->id)
            ->update(['is_accepted' => false]);

        return $this->responseApi('bid is supported by contractor,reject other bids', $otherbids, 200);

    } else {
       
        $bid->update([
              'is_accepted' => false,
        ]);

        return $this->responseApi('offer reject, see other bids', $bid, 200);
    }








}






}
