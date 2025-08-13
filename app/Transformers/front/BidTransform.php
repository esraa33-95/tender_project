<?php

namespace App\Transformers\front;

use App\Models\Bid;
use League\Fractal\TransformerAbstract;

class BidTransform extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Bid $bid):array
    {
        return [
            'project_id'=>$bid->project_id,
            'contractor_id'=>$bid->contractor_id,
            'price'=>$bid->price,
            'is_accepted'=>$bid->is_accepted,
        ];
    }
}
