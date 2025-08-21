<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\User;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class CommentController extends Controller
{     use ResponseTrait;
     public function index(){
        // Fetch all comments
        
       
        $comment=Comment::with('user')->get();
         
        return $this->successResponse(CommentResource::collection($comment),__('message.comment_index'),200);
    }
public function store(Request $request, $type, $id)
{
    // Validate the request
    $request->validate([
        'content' => 'required|string',
    ]);

    // Check if the type is valid
    $validTypes = ['News', 'Initiative', 'Project']; // تأكد من تطابق الأسماء مع أسماء الـ Models
    if (!in_array(ucfirst($type), $validTypes)) {
        return response()->json(['error' => 'Invalid type'], 400);
    }

    // Create the comment
    $modelClass = "App\\Models\\" . ucfirst($type); 
    $model = $modelClass::findOrFail($id);

    $comment = $model->comments()->create([
        'content' => $request->input('content'),
       'user_id' => auth()->id(), // Assuming the user is authenticated
    ]);

    $comment->loadMissing('user'); // Eager load the user relationship

    return $this->successResponse(new CommentResource($comment), __('message.comment_store'), 201);
}

    public function show(Comment $comment){
            $comment->loadMissing('user');
        return $this->successResponse(new CommentResource($comment),__('message.comment_show'),200);
    }
    public function update(CommentRequest $request, Comment $comment){
        $commentValided=$request->validated();
        $comment->update($commentValided);
            $comment->loadMissing('user');
        return $this->successResponse(new CommentResource($comment),__('message.project_update'),200);
    }
    public function destroy(Comment $comment){
        $comment->delete();
        return $this->successResponse(null,__('message.comment_delete'),200);   
    }
}
