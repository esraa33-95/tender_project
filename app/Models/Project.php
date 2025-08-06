<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

  public  const New = 1;
  public  const RUNNING = 2;
  public  const COMPLETED = 3;

    protected $fillable =[
        'user_id',
        'project_type_id',
        'name',
        'area',
        'contractor_name',
        'description',
        'budget_from',
        'budget_to',
        'open_budget',
        'location',
        'duration',
        'image',
        'start_date',
        'end_date',
        'status'
    ];

public function users()
{
  return $this->belongsTo(User::class);
}

public function projecttype()
{
  return $this->belongsTo(ProjectType::class);
}

public function projectrooms()
{
  return $this->hasMany(ProjectRoom::class);
}


}
