<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomZoneTranslation extends Model
{
    public $timestamps = true;
     
    protected $fillable =['name'];

    
    public function roomzone()
    {
        return $this->belongsTo(RoomZone::class);
    }
}
