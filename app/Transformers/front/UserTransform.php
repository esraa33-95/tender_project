<?php

namespace App\Transformers\front;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransform extends TransformerAbstract
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
    public function transform(User $user):array
    {
        return [
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'user_type'=>$user->user_type,
        ];
    }
}
