<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ٍReviewController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin,user');
    }

    public function index(){
//        $posts=Post::where('status','Approved')->get();
        $commments=comment::all();
//        $user=User::find(1);

        return response_data($commments,'');

    }

    public function store(Request $request, $post_id)
    {
        // Now, $post_id contains the value from the URL parameter
        $data = $request->validate([
            'content' => 'required',
        ]);

        $post = Post::find($post_id);

        if (!$post) {
            return response_data(null, "Post not found", 404);
        }

        $data['post_id']=$post_id;

        $comment=Comment::create($data);

        return response_data($comment,"comment has been added");

    }

    public function delete($id){
        comment::where('id',$id)->delete();

        return response_data('','comment has deleted successfully');

    }

    public function update(Request $request ,$id){

        comment::where('id',$id)->update($request->only('content'));
        $comment = Post::findOrFail($id);

        return response_data($comment,'comment updated successfully');

    }

}
