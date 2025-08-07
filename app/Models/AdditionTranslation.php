<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionTranslation extends Model
{
    public $timestamps = true;
     
    protected $fillable =['name'];


    public function addition()
    {
        return $this->belongsTo(Addition::class);
    }
}
