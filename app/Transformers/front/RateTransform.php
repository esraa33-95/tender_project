<?php

namespace App\Transformers\front;

use League\Fractal\TransformerAbstract;
use App\Models\Rate;

class RateTransform extends TransformerAbstract
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
    public function transform(Rate $rate):array
    {
        return [
            'project_id'=>$rate->project_id,
            'contractor_id'=>$rate->contractor_id,
            'user_id'=>$rate->user_id,
            'rate'=>$rate->rate,
        ];
    }
}
