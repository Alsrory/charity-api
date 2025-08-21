<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberRequest;
use App\Http\Resources\SubscriberResource;
use App\Models\Subscriber;
use App\Trait\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{   use ResponseTrait;
   // ✅ List all subscribers (admin only)
    public function index()
    {   $subscribers = Subscriber::with('user')->get();
        $message= $subscribers->isEmpty() ?  __('message.user_is_not_subscriber') : __('message.user_is_subscriber');
        
        return $this->successResponse( SubscriberResource::collection($subscribers), $message, 200);
    }

    //  Subscribe a user (first-time subscription)
    public function store(SubscriberRequest $request)
    {     $sub=$request->validated();
        //   $user = Auth::user();

        // Prevent duplicate subscriptions
        // if ($user->subscriber) {
        //     return $this->errorResponse(['message' => 'User is already subscribed.'], 409);
        // }


        $subscriber = Subscriber::create($sub );
        $subscriber->loadMissing('user');
        return $this->successResponse( new SubscriberResource($subscriber),__('message.subscriber_store'), 201);
    }

    // Show one subscriber
    public function show(Subscriber $subscriber)
    {   $subscriber->loadMissing(['user', 'subscriptions']);

        return $this->successResponse(new SubscriberResource($subscriber), 'Subscriber retrieved successfully.', 200);
    }
    

    //  Update subscription (e.g., status)
    public function update(Request $request, Subscriber $subscriber)
    {
          $subscriber->loadMissing('user');

        

        $subscriber->update([
            'status' => $request->status,
        ]);

        return $this->successResponse( new SubscriberResource($subscriber),__('message.subscriber_update'), 200);
    }

    //  Cancel/delete a subscription
    public function destroy(Subscriber $subscriber)
    {
        
        $subscriber->delete();

        return $this->successResponse(null,__('message.subscriber_delete'), 200);
    }

    // ✅ Get current authenticated user's subscription
//  public function userSubscriptions(Subscriber $subscriber)
//     {    $subscriber->loadMissing('subscriptions'); // Eager load the 'subscribtion' relationship
//         $subscriptions = $subscriber->subscriptions; // Assuming you have a 'subscriptions' relationship in the User model
//         return $this->successResponse(  $subscriptions, __('message.user_subscriptions'), 200);
//     }
    // ✅ Get all subscriptions for a subscriber (admin only) in a specific month and year
    // public function getSubscriberSubscriptions(Request $request, Subscriber $subscriber)
    // {    
    //     $subscriber->loadMissing('subscriptions'); // Eager load the 'subscriptions' relationship
    //     $subscriptions = $subscriber->subscriptions; // Assuming you have a 'subscriptions' relationship in the Subscriber model

    //     $month = $request->query('month');
    //     $year = $request->query('year');

    //     if ($month && $year) {
    //         $subscriptions = $subscriptions->filter(function ($subscription) use ($month, $year) {
    //             return Carbon::parse($subscription->created_at)->month == $month &&
    //                    Carbon::parse($subscription->created_at)->year == $year;
    //         });
    //     }

    //     return $this->successResponse(SubscriberResource::collection($subscriptions), __('message.subscriber_subscriptions'), 200);
    // }
    // ✅ Get all subscriptions for a subscriber (admin only) in a specific month and year
    public function getSubscriptions(Request $request)
{
    $month = $request->query('month');
    $year = $request->query('year', now()->year);

    $subscribers = Subscriber::with(['user', 'subscriptions' => function ($query) use ($month, $year) {
        $query->where('month', $month)
              ->whereYear('created_at', $year);
    }])->get();

    return $this->successResponse(
        SubscriberResource::collection($subscribers),
        __('message.subscription_index'),
        200
    );
}


}

   