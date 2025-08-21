<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\NewsResource;
use App\Http\Resources\ProjectResource;
use App\Models\News;
use App\Models\Project;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    use ResponseTrait;
 public function __construct()
    {

    }
    public function index()
    {
      $news=News::with('user')->get();
        return $this->successResponse(NewsResource::collection($news), __('message.news_index'), 200);
        //return response()->json($projects, 200);
        
    }

    // Additional methods for creating, updating, and deleting projects

    // For example:
    public function show(News $news)
    {
       
        return $this->successResponse(new NewsResource($news), __('message.news_show'), 200);
    }
   
    public function store(NewsRequest $request)
    {  
        // dd('Store method called');
        
        $validatedData = $request->validated();
        $news = News::create($request->except('photo'));
         // dump([$validatedData, $news]);
        if ($request->hasFile('photo')) {
    $news->addMediaFromRequest('photo')->toMediaCollection('image_news');
}

        // return redirect()->route("projects.views")->with("success","تم حفظ المقال  بنجاح ");
        return $this->successResponse(new NewsResource($news), __('message.news_store'), 200);
       
    }
    public function update(NewsRequest $newsRequest , News $news)
    {
        $validatedData = $newsRequest->validated();
         $news->update( $newsRequest->except('photo'));
         // dump([$validatedData, $news]);  
         if ($newsRequest->hasFile('photo')) {
            $news->addMediaFromRequest('photo')->toMediaCollection('image_news');
        }
    
        return $this->successResponse(new NewsResource($news), __('message.news_update'), 200);
        // return response()->json($project, 200);

    }
    public function destroy(News $news)
    {
        $news->delete();
        // dd('Project deleted successfully');
        return $this->successResponseWithMessage( __('message.news_delete'), 200);
        // return response()->json(null, 204);
    }

    


}
