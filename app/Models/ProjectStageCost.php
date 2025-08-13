<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStageCost extends Model
{
    protected $fillable = ['project_id', 'stage_name', 'stage_cost'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
