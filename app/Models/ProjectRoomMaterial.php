<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRoomMaterial extends Model
{
    public const CEIL = 1;
    public const FLOOR = 2;
    public const WALL = 3;

     protected $fillable = [
        'project_room_id', 
        'material_category_id',
        'type'
    ];

    public function projectroom()
    {
        return $this->belongsTo(ProjectRoom::class, 'project_room_id');
    }

    public function material()
    {
        return $this->belongsTo(MaterialCategory::class, 'material_category_id');
    }

}
