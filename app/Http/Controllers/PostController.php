<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
//    protected $column=['name','image','content','price'];
    protected $column=['name','content','price'];
    protected $column_admin=['status','reject_reason'];



    public function __construct() {
        $this->middleware('auth:admin,user');
    }

    public function index(){
        $posts=Post::where('status','Approved')->get();
        return response()->json([
            "posts" => $posts
        ]);
    }
    public function waiting_list(){
        $posts=Post::where('status','Pending')->get();
        return response()->json([
            "posts" => $posts
        ]);
    }
    public function show($id){
        $post=DB::table('posts')->where('id',$id)->find($id);
        // $post=Post::where('id',$id)->get();
        // Carbon::parse($post->created_at)->diffForHumans();

        return response()->json([
            "post" => $post
        ]);
    }
    public function search($query){
        $results=Post::where('name','like',"%".$query."%")
            ->orWhere('price','like',"%".$query."%")
            ->get($this->column);
        if (count($results)){

            return response()->json([
                "results"=>$results
            ]);
        }else{
            return response()->json([
                "results"=> "No results found :("
            ]);
        }
    }

    public function store(Request $request){
        $data=$request->validate([
            "name"=>"required|string",
            "content"=>"required|string",
            "price"=>"required|numeric",
//            "image"=>"required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
        ]);
//        $data['image']=$request->file('image')->store('images');
        $data['user_id']=Auth::user()->id;
        $user=User::where('id',$data['user_id'])->get();

        Post::create($data);

        return response()->json([
            "message" => "Post has been added",
            "user"=>$user,
        ]);

    }

    public function delete($id){
        DB::table('posts')->where('id',$id)->delete($id);
        return response()->json([
            'message'=>'Post has deleted successfully'
        ]);
    }
    public function update(Request $request ,$id){

        $post = Post::where('id',$id)->update($request->only($this->column));
        $post = Post::findOrFail($id);
        return response()->json([
            "message"=>"Post updated successfully",
            "post"=>$post
        ]);
    }
    public function update_admin(Request $request ,$id){

        $post = Post::where('id',$id)->update($request->only($this->column_admin));
        $post = Post::findOrFail($id);
        return response()->json([
            "message"=>"Updated successfully (admin)",
            "post"=>$post
        ]);
    }
}
