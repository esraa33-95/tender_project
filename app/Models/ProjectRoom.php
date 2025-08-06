<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRoom extends Model
{
    protected $fillable =[
        'project_id',
        'room_zone_id',
        'length',
        'height',
        'width',
        'image',
        'description'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function roomZone()
    {
        return $this->belongsTo(RoomZone::class);
    }

    public function projectrooms()
{
  return $this->hasMany(ProjectRoom::class);
}


}
