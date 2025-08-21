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
    public function index( )
    {    
         $initaitives=Initiative::all();
       
     return $this->successResponse( InitiativeResource::collection( $initaitives),__('message.donation_index'),200);
    } 

    /**
     * Store a newly created resource in storage.
     */
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
     * Display the specified resource.
     */
    public function show(Initiative $initiative )
    {
        return $this->successResponse(new InitiativeResource($initiative) ,__('message.initiative_show'),200);
    }

   
    /**
     * Update the specified resource in storage.
     */
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
     * Remove the specified resource from storage.
     */
    public function destroy(Initiative $initiative)
    {
        $initiative->delete();
        return $this->successResponse(null, __('message.initiative_delete'), 200);
    }
  
}
