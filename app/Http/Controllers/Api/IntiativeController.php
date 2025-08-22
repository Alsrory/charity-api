<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IntiativeRequest;
use App\Http\Resources\InitiativeResource;
use App\Models\Initiative;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class IntiativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ResponseTrait;
     public function __construct()
    {
        // You can apply middleware here if needed
        // $this->middleware('auth:sanctum');
    }
     /**
     * @OA\Get(
     *     path="/api/initiatives",
     *     summary="جلب كل المبادرات",
     *     tags={"Initiatives"},
     *     @OA\Response(response=200, description="نجاح العملية", @OA\JsonContent(ref="#/components/schemas/InitiativeResponse"))
     * )
     */
    // ✅ List all initiatives
    public function index( )
    {    
         $initaitives=Initiative::all();
       
     return $this->successResponse( InitiativeResource::collection( $initaitives),__('message.donation_index'),200);
    } 

   /**
     * @OA\Post(
     *     path="/api/initiatives",
     *     summary="إنشاء مبادرة جديدة",
     *     tags={"Initiatives"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","description"},
     *             @OA\Property(property="name", type="string", example="مبادرة خيرية"),
     *             @OA\Property(property="description", type="string", example="تفاصيل المبادرة")
     *         )
     *     ),
     *     @OA\Response(response=201, description="تم الإنشاء", @OA\JsonContent(ref="#/components/schemas/InitiativeResponse"))
     * )
     */
    // ✅ Create a new initiative (admin only)
    public function store(IntiativeRequest $request)
    {
         $validData=$request->validated();
         
       $data= Initiative::create(
        $request->except('photo'),
    //   'user_id' => $request->user()->id ||null , // Assuming you want to associate the initiative with the authenticated user   
    );
    if($request->hasFile('photo')){
        $data->addMediaFromRequest('photo')->toMediaCollection('image_initaitive');
    }
       return $this->successResponse(new InitiativeResource($data),__('message.donation_store'),200);
    }

     /**
     * @OA\Get(
     *     path="/api/initiatives/{id}",
     *     summary="عرض مبادرة واحدة",
     *     tags={"Initiatives"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="نجاح العملية", @OA\JsonContent(ref="#/components/schemas/InitiativeResponse")),
     *     @OA\Response(response=404, description="غير موجود")
     * )
     */
    // ✅ Show one initiative by ID
    public function show(Initiative $initiative )
    {
        return $this->successResponse(new InitiativeResource($initiative) ,__('message.initiative_show'),200);
    }

   
    /**
     * @OA\Put(
     *     path="/api/initiatives/{id}",
     *     summary="تحديث مبادرة",
     *     tags={"Initiatives"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="مبادرة محدثة"),
     *             @OA\Property(property="description", type="string", example="تفاصيل محدثة")
     *         )
     *     ),
     *     @OA\Response(response=200, description="تم التحديث", @OA\JsonContent(ref="#/components/schemas/InitiativeResponse")),
     *     @OA\Response(response=404, description="غير موجود")
     * )
     */
    // ✅ Update a initiative (admin only)
    public function update(IntiativeRequest $request, Initiative $initiative)
    {
        $validData = $request->validated();
        $initiative->update($validData);
        if ($request->hasFile('photo')) {
            $initiative->addMediaFromRequest('photo')->toMediaCollection('image_initaitive');
        }
        return $this->successResponse(new InitiativeResource($initiative), __('message.initiative_update'), 200);
    }
  

    /**
     * @OA\Delete(
     *     path="/api/initiatives/{id}",
     *     summary="حذف مبادرة",
     *     tags={"Initiatives"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="تم الحذف"),
     *     @OA\Response(response=404, description="غير موجود")
     * )
     */
    // ✅ Delete a initiative (admin only)
    public function destroy(Initiative $initiative)
    {
        $initiative->delete();
        return $this->successResponse(null, __('message.initiative_delete'), 200);
    }
  
}
