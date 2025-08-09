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
            // 'user_name' => $project->user->name,   
            // 'project_type_name' => $project->projectType,
            'name' => $project->name,
            'area' => $project->area,
            'description' => $project->description,
            'budget_from' => $project->budget_from,
            'budget_to' => $project->budget_to,
            'open_budget' => $project->open_budget,
            'location' => $project->location,
            'duration' => $project->duration,
            'start_date' => $project->start_date,
            'image'=>$project->getFirstMedia('images') ?: asset('storage/1.jpg'),
            'status' => $project->status,
        ];
    }
}
