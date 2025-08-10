<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Project extends Model implements  HasMedia
{
  use InteractsWithMedia;

  public  const New = 1;
  public  const RUNNING = 2;
  public  const COMPLETED = 3;

   
   
    protected $fillable =[
        'user_id',
        'project_type_id',
        'area',
        'name',
        'description',
        'budget_from',
        'budget_to',
        'open_budget',
        'location',
        'duration',
        'image',
        'start_date',
        'status'
    ];

public function users()
{
  return $this->belongsTo(User::class);
}

public function projecttype()
{
  return $this->belongsTo(ProjectType::class,'project_type_id');
}

public function projectrooms()
{
  return $this->hasMany(ProjectRoom::class);
}


}
