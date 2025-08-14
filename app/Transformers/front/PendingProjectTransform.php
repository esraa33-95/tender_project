<?php

namespace App\Transformers\front;

use League\Fractal\TransformerAbstract;
use App\Models\Project;

class PendingProjectTransform extends TransformerAbstract
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
    public function transform(Project $pending):array
    {
        return [
            'id' => $pending->id,
            'user_id' => $pending->user_id, 
            'project_type_id' => $pending->project_type_id,
            'name'=>$pending->name,
            'area' => $pending->area,
            'budget_from' => $pending->budget_from,
            'budget_to' => $pending->budget_to,
            'open_budget' => $pending->open_budget,
            'location' => $pending->location,
            'duration' => $pending->duration,
            'start_date' => $pending->start_date,
            'status' => $pending->status,
            
            
            
        ];


        
    }
}
