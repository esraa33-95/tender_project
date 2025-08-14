<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomMaterial extends Model
{
    protected $table = 'material_rooms';
    
    protected $fillable = [
        'project_room_id',
        'material_type',
        'material_category_id'
    ];

    public function material()
    {
        return $this->belongsTo(MaterialCategory::class, 'material_category_id');
    }

    public function room()
    {
        return $this->belongsTo(ProjectRoom::class, 'project_room_id');
    }
}

