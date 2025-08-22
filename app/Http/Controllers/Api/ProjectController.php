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
     /**
     * @OA\Get(
     *     path="/api/projects",
     *     summary="جلب كل المشاريع",
     *     tags={"Projects"},
     *     @OA\Response(response=200, description="نجاح العملية", @OA\JsonContent(ref="#/components/schemas/ProjectResponse"))
     * )
     */
    // ✅ List all projects 
    public function index()
    {
       $projects = Project::all(); // Assuming you have a Project model
    //    LogHelper::event('error', [
    //         'count' => $projects->count(),
           
           
    //     ],  [ 'massage' => 'Project index accessed']);
        return $this->successResponse(ProjectResource::collection($projects), __('message.project_index'), 200);
        //return response()->json($projects, 200);
        
    }

    /**
     * @OA\Get(
     *     path="/api/projects/{id}",
     *     summary="عرض مشروع واحد",
     *     tags={"Projects"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="نجاح العملية", @OA\JsonContent(ref="#/components/schemas/ProjectResponse")),
     *     @OA\Response(response=404, description="غير موجود")
     * )
     */
    // ✅ Show one project by ID
    public function show(Project $project)
    {
       
        return $this->successResponse(new ProjectResource($project), __('message.project_show'), 200);
    }
   /**
     * @OA\Post(
     *     path="/api/projects",
     *     summary="إنشاء مشروع جديد",
     *     tags={"Projects"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","description","status"},
     *             @OA\Property(property="name", type="string", example="مشروع خيري"),
     *             @OA\Property(property="description", type="string", example="تفاصيل المشروع"),
     *             @OA\Property(property="status", type="string", example="active")
     *         )
     *     ),
     *     @OA\Response(response=201, description="تم الإنشاء", @OA\JsonContent(ref="#/components/schemas/ProjectResponse"))
     * )
     */
    // ✅ Create a new project (admin only)
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
    /**
     * @OA\Put(
     *     path="/api/projects/{id}",
     *     summary="تحديث مشروع",
     *     tags={"Projects"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="مشروع محدث"),
     *             @OA\Property(property="description", type="string", example="تحديث التفاصيل"),
     *             @OA\Property(property="status", type="string", example="inactive")
     *         )
     *     ),
     *     @OA\Response(response=200, description="تم التحديث", @OA\JsonContent(ref="#/components/schemas/ProjectResponse")),
     *     @OA\Response(response=404, description="غير موجود")
     * )
     */
    // ✅ Update a project (admin only)
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
    /**
     * @OA\Delete(
     *     path="/api/projects/{id}",
     *     summary="حذف مشروع",
     *     tags={"Projects"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="تم الحذف"),
     *     @OA\Response(response=404, description="غير موجود")
     * )
     */
    // ✅ Delete a project (admin only)
    public function destroy(Project $project)
    {
        $project->delete();
        // dd('Project deleted successfully');
        return $this->successResponseWithMessage( __('message.project_delete'), 200);
        // return response()->json(null, 204);
    }

}
