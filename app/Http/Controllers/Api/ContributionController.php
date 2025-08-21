<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContributionRequest;
use App\Models\Contribution;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    //
  use ResponseTrait;
    public function __construct()
    {
        // You can apply middleware here if needed
        // $this->middleware('auth:sanctum');
    }

    public function index()
    {
       $contributions = Contribution::with('user')->get(); // Assuming you have a Contribution model with user relationship
        return $this->successResponse($contributions, __('message.contribution_index'), 200);
    }
    public function show(Contribution $contribution)
    {
        return $this->successResponse($contribution, __('message.contribution_show'), 200);
    }
    public function store(ContributionRequest $request){
        $data = $request->validated();
         

        $contribution = Contribution::create($data);
        return $this->successResponse($contribution, __('message.contribution_store'), 201);
    }
    public function update(ContributionRequest $request, Contribution $contribution)
    {
        $data = $request->validated();
        $contribution->update($data);
        return $this->successResponse($contribution, __('message.contribution_update'), 200);
    }
    public function destroy(Contribution $contribution)
    {
        $contribution->delete();
        return $this->successResponse(null, __('message.contribution_delete'), 204);    
    }
    public function userContributions(Contribution $contribution)
    {    
        $contribution->loadMissing('user'); // Eager load the 'user' relationship
        $contributions = $contribution->user; // Assuming you have a 'user' relationship in the Contribution model
        return $this->successResponse($contributions, __('message.user_contributed'), 200);
    }


}
