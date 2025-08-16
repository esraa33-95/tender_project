<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\front\RateContractor;
use App\Models\Rate;
use App\Models\Project;
use App\Traits\Response;
use App\Transformers\front\RateTransform;
use League\Fractal\Serializer\ArraySerializer;

class RatingController extends Controller
{
    use Response;

    //store rating
    public function ratecontractor(RateContractor $request , string $id)
    {
       // $user = auth()->user();

      $data = $request->validated();

      $project = Project::with('bids')
                         ->where('status', Project::COMPLETED)
                         ->findOrFail($id);

    $rating = Rate::where('project_id', $id)
                  // ->where('user_id', $user->id())
                     ->exists();

    if ($rating)
        {
        return $this->responseApi('messages.no_rate');
        }

       $rate = Rate::create($data);

        $project = fractal($rate, new RateTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('messages.store_rate'));

    }
}
