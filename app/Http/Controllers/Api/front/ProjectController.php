<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\StoreProject;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Traits\Response;
use App\Transformers\front\ProjectTransform;
use League\Fractal\Serializer\ArraySerializer;

class ProjectController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProject $request )
    {
        $data = $request->validated();

      $project = Project::create($data);

     if ($request->hasFile('image'))
             {
              $project->addMedia($request->file('image'))
                       ->toMediaCollection('images');
             }

        $project = fractal($project, new ProjectTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('store project successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
