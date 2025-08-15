<?php

namespace App\Transformers\front;

use App\Models\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransform extends TransformerAbstract
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
    public function transform(Project $project):array
    {
        return [
            'id' => $project->id,
            'user_id' => $project->user_id,
            'contractor_id' => $project->contractor_id, 
            'project_type_id' => $project->project_type_id,
            'name'=>$project->name,
            'area' => $project->area,
            'budget_from' => $project->budget_from,
            'budget_to' => $project->budget_to,
            'open_budget' => $project->open_budget,
            'location' => $project->location,
            'duration' => $project->duration,
            'start_date' => $project->start_date,
            'image'=>$project->getFirstMedia('images') ?: asset('storage/1.jpg'),
            'status' => $project->status,
            'cancel_reason'=>$project->cancel_reason,

            

            'bids' => $project->bids ? $project->bids->map(function ($bid) {
               return [
                      'id'  => $bid->id,
                    'contractor_id' => $bid->contractor_id,
                    'contractor_name' => $bid->contractor->name,
                    'contractor_email' => $bid->contractor->email,
                    'price'  => $bid->price,
                    'status'   => $bid->status,
        
                  ];
           }) : null,

    
        ];


        
    }
}
