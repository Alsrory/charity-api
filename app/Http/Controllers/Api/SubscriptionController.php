<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
   use ResponseTrait;
    public function index(Request $request){
        
        $subscription=Subscription::all();
        return $this->successResponse(SubscriptionResource::collection($subscription),__('message.subscription_index'),200);

    }
    public function show(Subscription $subscription){
        $subscription->load('subscriber'); // Eager load the 'subscriber' relationship
        return $this->successResponse($subscription,__('message.subscription_show'),200);
    }
    public function store(SubcriptionRequest $request){
        $data=$request->validated();
        $subscription=Subscription::create($data);
        return $this->successResponse($subscription,__('message.subscription_store'),201);
    }
    public function update(SubcriptionRequest $request,Subscription $subscription){
        $data=$request->validated();
        $subscription->update($data);
        return $this->successResponse($subscription,__('message.subscription_update'),200);
    }
    public function destroy(Subscription $subscription){
        $subscription->delete();
        return $this->successResponse(null,__('message.subscription_destroy'),204); 
    }
    public function userSubscriptions(Subscription $subscription)
    {    
        $subscription->loadMissing('subscriber'); // Eager load the 'subscriber' relationship
        $subscriptions = $subscription->subscriber; // Assuming you have a 'subscribe' relationship in the Subscription model
        return $this->successResponse($subscriptions, __('message.user_subscriptions'), 200);
    }
        
    
}
