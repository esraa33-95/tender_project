<?php

namespace App\Transformers\front;

use League\Fractal\TransformerAbstract;
use App\Models\User;

class ContractorTransform extends TransformerAbstract
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
    public function transform(User $contractor):array
    {
        return [
            'id'    => $contractor->id,
            'name'  => $contractor->name,
            'email' => $contractor->email,
            
        ];
    }
}
