<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Addition extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['name'];

    protected $fillable = ['room_zone_id','added_date'];

    public function translates()
    {
        return $this->hasMany(AdditionTranslation::class);
    }
    
     public function additiontypes()
    {
      return $this->hasMany(AdditionType::class);
    }
    
    public function roomzone()
    {
      return $this->belongsTo(RoomZone::class,'room_zone_id');
    }

    public function projectRooms()
    {
        return $this->belongsToMany(ProjectRoom::class, 'addition_project_rooms')->withPivot('amount')
                    ->withTimestamps();
    }
}
