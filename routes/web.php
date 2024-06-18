<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' =>"dashboard",'middleware' => 'adminauth'],function(){
    
    // Route::get('/', function (Request $request) {

    //     $adminData = auth()->user();
        
    //     return view('Dashboard.index', ['adminData' => $adminData]);
        
    // })->name('dashboard');

    Route::get('/users', function () {
        return view('Dashboard.users');
    })->name('dashboard.users');

    Route::get('/settings', function () {
        // echo "Settings Page";
        return view('Dashboard.settings');
    })->name("dashboard.setting");

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/login', [AdminController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminController::class, 'postLogin'])->name('adminLoginPost');

    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/', function () {
            $admin = auth()->guard('admin')->user();
            $posts=Post::all();
            return view('Dashboard.index',['admin' => $admin,'posts'=>$posts]);
        })->name('dashboard');

        Route::get('/users', function () {
            $admin = auth()->guard('admin')->user();
            $users = User::all();
            return view('users.users',['admin' => $admin,'users' => $users]);
        })->name('users');

        Route::get('/users/{user}/edit', function () {
            $admin = auth()->guard('admin')->user();
            $users = User::all();
            return view('users.edit',['admin' => $admin,'users' => $users]);
        })->name('users.edit');

        Route::get('/waiting-list', function () {
            $admin = auth()->guard('admin')->user();
            $posts=Post::all();
            return view('Dashboard.waitingList',['admin' => $admin,'posts'=>$posts]);
        })->name('waiting');

        Route::get('/rejected-list', function () {
            $admin = auth()->guard('admin')->user();
            $posts=Post::all();
            return view('Dashboard.rejectedList',['admin' => $admin,'posts'=>$posts]);
        })->name('rejected');


        //users actions

        // profile

        Route::get('/users/profile/{user}',function(User $user){
            $admin = auth()->guard('admin')->user();
            // $user = auth()->user();
            $user_posts=$user->posts;
            return view('users.profile',compact('user','admin','user_posts'));
        })->name('users.profile');

        //Edit
        Route::get('/users/{user}/edit',function(User $user){
            $admin = auth()->guard('admin')->user();
            // $users = User::all();
            return view('users.edit',compact('user','admin'));

        })->name('users.edit');

        Route::put('users/{user}',function(Request $request, User $user){
            // $admin = auth()->guard('admin')->user();

            $column=['name','user_type','address'];

            $request->validate([
                'name' => 'nullable|string|max:255',
                'address'=>'nullable|string|max:200',
                // 'phone_number'=>'nullable|string|min:11|max:11|unique:users',
                'user_type'=>'nullable|string|max:255'
            ]);

            User::where('id',$user->id)->update($request->only($column));
            // if there errors , return with errors 

            return redirect()->back()->with('success', 'Post updated successfully.');
            // return redirect()->back()->errors();

        })->name('user.update');

        // Delete

        Route::delete('users/{user}/delete',function(User $user){
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        })->name('user.delete');
        //--------------------------------------------
        // Admin pages + actions

        Route::get('profile/{admin}',function(Admin $admin){
            $admin = auth()->guard('admin')->user();
            return view('admin.profile',compact('admin'));
        })->name('admin.profile');




        //--------------------------------------------

        // Posts actions

        // accept

        Route::post('/posts/{post}/accept', function(Post $post){
        
            $post->update(['status' => 'approved']);
            return redirect()->back()->with('success', 'Post has been approved successfully.');
            
        
        })->name('posts.accept');
        
        // reject

        Route::put('/posts/{post}/reject', function(Request $request, Post $post){
        
            $request->validate([
                'reject_reason' => 'required|string|max:255',
            ]);
        
            $post->update(['status' => 'rejected']);
            $post['reject_reason']=$request->reject_reason;
            $post->save();
        
            return redirect()->back()->with('success', 'Post has been rejected successfully.');
        
        })->name('posts.reject');

        // delete

        Route::delete('/posts/{post}/delete', function(Post $post){
        
            $post->delete();
                return redirect()->back()->with('success', 'Post has been deleted successfully.');
            
        
        })->name('posts.delete');

        // restore

        Route::post('/posts/{post}/restore', function(Post $post){
        
            $post->update(['status' => 'pending']);
            $post['reject_reason']='';
            $post->save();
        
            return redirect()->back()->with('success', 'Post has been restored successfully.');
        
        })->name('posts.restore');
        // ----------------------------------------------------------
        // edit page + action
        Route::get('/posts/{post}/edit', function(Post $post){
            $admin = auth()->guard('admin')->user();
            return view('posts.edit',compact('post','admin'));
        })->name('posts.edit');
        
        Route::put('/posts/{post}', function(Request $request, Post $post){
        
            $request->validate([
                'material' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric',
                'status' => 'nullable|string|max:255',
                'reject_reason' => 'nullable|string',
                "image"=>"nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048"
                
            ]);
            $img=$post['image'];
        
            if ($request->hasFile('image')) {
            
                if ($img) {
                    $path='images/posts/'.basename($img);
                    // dd($path);
                    Storage::disk('public')->delete($path);
                }
                // image  uploading
                $file=$request->file('image');
                $extension = $file -> getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $path='images/posts';
                $file->move(public_path($path) , $filename);
        
        
                // $User->image=$file->getRealPath();
                $post->image=url($path,$filename);
                // dd($c_post->image);
        
                $post->save();
        
            }
            $column=['material','description','price','quantity','status','reject_reason'];
        
            Post::where('id',$post->id)->update($request->only($column));
        
            return redirect()->back()->with('success', 'Post updated successfully.');
        
        })->name('posts.update');
        // ----------------------------------------------------------

    });
});






Route::get('/login', function () {
    return view('test.login');
})->name("login");

Route::get('/register',function(){
    return view('test.register');
})->name('register');

Route::get('/reset',function(){
    return view('test.reset');
})->name('reset');

Route::get('/logout',[AdminController::class,'adminLogout'])->name('dashboard.logout');

// routes/web.php


Route::get('/get/flask-access-token', function () {
    // URL of the Flask app endpoint
    $flaskAppUrl = 'https://rekiatestapi.pythonanywhere.com/get-access-token';

    // Make a GET request to the Flask app endpoint
    $response = Http::get($flaskAppUrl);

    // Check if the request was successful (status code 200)
    if ($response->successful()) {
        // Decode the JSON response
        $responseData = $response->json();

        // Extract the access token from the response
        $accessToken = $responseData['access_token'];
        // dd($accessToken);

        // Now you can use the access token in your Laravel application
        // For example, you can store it in a database or use it for authentication

        return response()->json(['access_token' => $accessToken]);
    } else {
        // If the request was not successful, return an error response
        return response()->json(['error' => 'Failed to retrieve access token'], $response->status());
    }
});


// Route::get('/index',function(){
//     return view('index');
// });
// Route::get('/profile', function () {
//     return view('test.reset');
// })->middleware("auth");


Route::group([
    'prefix'=>'login',
    'controller'=>SocialController::class
],function(){

    Route::get('/facebook', "redirect_facebook");
    Route::get('/facebook/callback', 'callback_facebook');

    Route::get('/google', "redirect_google");
    Route::get('/google/callback',"callback_google");


});
// create route to send notification

Route::get('notifiy/access/token',function(){
    return view('test.main');
});






