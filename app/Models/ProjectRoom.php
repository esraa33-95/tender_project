<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProjectRoom extends Model implements HasMedia
{
    use InteractsWithMedia;

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

  
    public function additionTypes()
{
    return $this->belongsToMany(AdditionType::class, 'addition_project_rooms')
                ->withPivot('amount')
                ->withTimestamps();
}

    
    public function materials()
{
    return $this->hasMany(RoomMaterial::class);
}



}
