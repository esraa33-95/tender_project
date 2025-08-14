<?php

namespace App\Listeners;

use App\Events\ProjectCostUpdated;
use App\Models\ProjectStageCost;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class CalculateProjectCost
{
    public function handle(ProjectCostUpdated $event)
    {
        $projectId = $event->projectId;
        
        
        $materialsCost = DB::table('material_rooms')
        ->join('material_categories', 'material_categories.id', '=', 'material_rooms.material_category_id')
        ->join('project_rooms', 'project_rooms.id', '=', 'material_rooms.project_room_id')
        ->where('project_rooms.project_id', $projectId)
        ->select(DB::raw('SUM(material_categories.price + (material_categories.price * material_categories.contractor_percentage / 100)) as total'))
        ->value('total') ?? 0;

    ProjectStageCost::create([
        'project_id' => $projectId,
        'stage_name' => 'Materials',
        'stage_cost' => $materialsCost
    ]);

   
    $additionsCost = DB::table('addition_project_rooms')
        ->join('additions', 'additions.id', '=', 'addition_project_rooms.addition_id')
        ->join('addition_types', 'addition_types.addition_id', '=', 'additions.id')
        ->join('project_rooms', 'project_rooms.id', '=', 'addition_project_rooms.project_room_id')
        ->where('project_rooms.project_id', $projectId)
        ->select(DB::raw('SUM((addition_types.price + (addition_types.price * addition_types.contractor_percentage / 100)) * addition_project_rooms.amount) as total'))
        ->value('total') ?? 0;

    ProjectStageCost::create([
        'project_id' => $projectId,
        'stage_name' => 'Additions',
        'stage_cost' => $additionsCost
    ]);

        
        $totalCost = $materialsCost + $additionsCost;

        Project::where('id', $projectId)->update([
            'total_cost' => $totalCost,
            
        ]);
    }
}
