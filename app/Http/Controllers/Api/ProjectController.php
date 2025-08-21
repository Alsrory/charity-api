<?php

namespace App\Http\Controllers\Api;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Trait\ResponseTrait;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProjectController extends Controller
{
    use ResponseTrait;
 public function __construct()
    {

    }
    public function index()
    {
       $projects = Project::all(); // Assuming you have a Project model
    //    LogHelper::event('error', [
    //         'count' => $projects->count(),
           
           
    //     ],  [ 'massage' => 'Project index accessed']);
        return $this->successResponse(ProjectResource::collection($projects), __('message.project_index'), 200);
        //return response()->json($projects, 200);
        
    }

    // Additional methods for creating, updating, and deleting projects

    // For example:
    public function show(Project $project)
    {
       
        return $this->successResponse(new ProjectResource($project), __('message.project_show'), 200);
    }
   
    public function store(ProjectRequest $request)
    {  
        // dd('Store method called');
        
        $validatedData = $request->validated();
        $project = Project::create($request->except('photo'));
        
        if ($request->hasFile('photo')) {
    $project->addMediaFromRequest('photo')->toMediaCollection('image_project');
}

        // return redirect()->route("projects.views")->with("success","تم حفظ المقال  بنجاح ");
       return $this->successResponse($project, __('message.project_store'), 200);
        // return $this->successResponse($project, __('message.project_store'), 201);
        // return response()->json($project, 201);
       
    }
    public function update(ProjectRequest $request, Project $project)
    {
        $validatedData = $request->validated();
        $project->update($validatedData);
        if ($request->hasFile('photo')) {
            $project->addMediaFromRequest('photo')->toMediaCollection('image_project');
        }
        return $this->successResponse($project, __('message.project_update'), 200);
        // return response()->json($project, 200);

    }
    public function destroy(Project $project)
    {
        $project->delete();
        // dd('Project deleted successfully');
        return $this->successResponseWithMessage( __('message.project_delete'), 200);
        // return response()->json(null, 204);
    }

    public function showView()
    {
        return view('add-project'); 
    }


public function showproject()
{
    $projects = Project::all();
  return view('projects', compact('projects'));

}
}
