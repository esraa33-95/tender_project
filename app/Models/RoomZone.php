<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class RoomZone extends Model implements TranslatableContract
{
    public const DRY = 1;
    public const WET = 2;

    use Translatable;

     public $translatedAttributes = ['name'];

    protected $fillable = ['added_date','type'];
   

    public function translates()
    {
        return $this->hasMany(RoomZoneTranslation::class);
    }

    public function projectRooms()
    {
        return $this->hasMany(ProjectRoom::class);
    }
    
     public function materials()
{
    return $this->belongsToMany(MaterialCategory::class,'material_rooms')
                                 ->withTimestamps();
}

}
