<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\IntiativeController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SubscriberController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/register',[RegisterController::class,'store']);

Route::post('/login',[LoginController::class,'login']);
// Route::post('/projecs',[ProjectController::class,'index']);

Route::group(['middleware'=>'language'],function(){
    //all  5 routes  index,store,show,updata
Route::apiResource('/users',UserController::class);
Route::apiResource('/projects',ProjectController::class);
Route::apiResource('/initiatives',IntiativeController::class);
Route::apiResource('/subscribers',SubscriberController::class);
Route::apiResource('/subscriptions',SubscriptionController::class);
Route::apiResource('/roles',RoleController::class);
Route::apiResource('/news',NewsController::class);
route::apiResource('/comments',CommentController::class);

Route::post('/{type}/{id}/comments', [CommentController::class, 'store']);
Route::get('/{type}/{id}/comments', [CommentController::class, 'index']);
//show all donate of  user done in the contributions   
Route::get('/users/{user}/contributions', [UserController::class, 'userContributions']);
// show all subscriptions of subscriber 
Route::get('/subscriber/{subscriber}/subscriptions', [SubscriberController::class, 'userSubscriptions']);
// show all subscriptions of subscriber 


});

Route::get('/subscription', [SubscriberController::class, 'getSubscriptions']);
