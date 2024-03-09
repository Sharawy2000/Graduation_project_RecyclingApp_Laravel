<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class PostController extends Controller
{
   protected $column=['name','image','content','price'];
    // protected $column=['name','content','price'];
    protected $column_admin=['status','reject_reason'];

    public function __construct() {
        $this->middleware('auth:admin,user');
    }

    public function index(){
//        $posts=Post::where('status','Approved')->get();
        $posts=Post::all();

        return response_data($posts,"");

    }
    public function waiting_list(){
        $posts=Post::where('status','Pending')->get();

        return response_data($posts,"");

    }
    public function show($id){

        $post=Post::find($id);
        $post->comments;
        $post->reactions;

        return response_data($post,"");
    }
    public function search($query){
        $results=Post::where('name','like',"%".$query."%")
            ->orWhere('price','like',"%".$query."%")
            ->get($this->column);

        $results_users=User::where('name','like',"%".$query."%")
            ->get('name');

        if (count($results)){

            return response_data([$results_users,$results],"Done");

        }else{

            return response_data('',"No results found :(");
        }

    }

    public function store(Request $request){
        $data=$request->validate([
            "material"=>"nullable|string",
            "description"=>"required|string",
            "quantity"=>"required|string",
            "price"=>"required|numeric",
            "image"=>"required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
        ]);

        $file=$request->file('image');
        $extension = $file -> getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path='images/posts/';
        $file->move($path , $filename);
        // $image_path="/Users/aait/Documents/GitHub/Graduation_project_RecyclingApp_Laravel/public/".$path . $filename ;

        $imagePath = public_path('images/posts/'.$filename); // Path to your image file
        // $pythonScriptPath = base_path('Image_classification_inhancement/predict.py');
        // dd($pythonScriptPath);
        $pythonScriptPath ="/Users/aait/Documents/wesam/Workspace/Image_classification_inhancement/predict.py";

    //    Execute Python script
        // $process = new Process(["python", $pythonScriptPath, $imagePath]);
        // $process->run();
        //  dd($process->run());
        $user_id=auth()->user()->id;
        // dd($user_id);
        $data['user_id']=$user_id;

        // $data['name']=$process->getOutput();

        $data['image']=url($path,$filename);
        // dd($process->getOutput());

        $post=Post::create($data);


        return response_data($post,"Post has been added");

    }
    public function update(Request $request ,$id){

        Post::where('id',$id)->update($request->only($this->column));
        $post = Post::findOrFail($id);

        return response_data($post,"Post updated successfully");
    }
    public function update_admin(Request $request ,$id){

        Post::where('id',$id)->update($request->only($this->column_admin));
        $post = Post::findOrFail($id);
        $admin=auth()->user();
        return response_data($post,"Admin {$admin->name} Updated post id#{$id}");
    }

    public function delete($id){

        Post::where('id',$id)->delete();
        return response_data('Post deleted successfully');
    }

    public function get_category($category){
        $cat=Post::where("material",$category)->get();
        return response_data($cat,$category." category");

    }
}
