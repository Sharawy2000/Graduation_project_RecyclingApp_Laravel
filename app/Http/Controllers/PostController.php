<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\SellerNotification;
use App\Models\BuyerNotification;
use App\Models\ConfirmationNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Services\Notifications\NotificationService;

class PostController extends Controller
{
    protected $column=['material','description','price','quantity'];

    protected $column_admin=['status','reject_reason'];
    
    protected $notificationService;

    public function __construct(NotificationService $notificationService) {
        $this->middleware('auth:admin,user');
        $this->notificationService = $notificationService;
    }

    public function index(){
        $posts=Post::where('available',True)
                        ->orderBy('created_at', 'desc')
                        ->get();


        return response_data($posts,"");

    }
    public function waiting_list(){
        $posts=Post::where('status','Pending')->get();

        return response_data($posts,"");

    }
    public function show($id){

        $post=Post::find($id);

        return response_data($post,"");
    }
    public function search($query){
        $results=Post::where('location','like',"%".$query."%")
            ->get();
        
        if (count($results)){
            
            return response_data($results,"Done");

        }else{

            return response_data('',"No results found :(");
        }

    }
    
    public function image_classification(Request $request){
        
        // Check if image file is uploaded
        if ($request->hasFile('image')) {
            // Get the image file from the request
            $image = $request->file('image');
    
            // Send POST request to Flask API
            $response = Http::attach(
                'image',
                file_get_contents($image->path()),
                $image->getClientOriginalName()
            )->post('https://rekiatestapi.pythonanywhere.com');
    
            // Handle the response
            $predictions = $response->json();
    
            return response()->json($predictions);
        } else {
            // Handle the case when image is not uploaded
            return response_data('',"Image file not found in the request",400);
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
        $path='images/posts';
        $file->move($path , $filename);

        $user=auth()->user();
        
        $data['user_id']=$user->id;


        $data['image']=url($path,$filename);

        $data['location']=$user->city;

        $post=Post::create($data);
        
        // Find users interested in the material of the new post
        $interestedUsers = User::where('interests', 'like', "%{$post->material}%")->get();
        

        // Send notifications to interested users

        if (!empty($interestedUsers)) {

            $title = "New Post in Material: " . $post->material;
            $body = "A new post has been created: " . $post->description;

            foreach ($interestedUsers as $user) {
                
                $r=$this->notificationService->sendNotification($user['fcm_token'], $title, $body);
                // dd($r);
            }
            
        }


        return response_data($post,"Post has been added");

    }
    
    public function update(Request $request ,$id){

        $post = Post::findOrFail($id);
        
        if($post->user_id==auth()->id() || auth()->user()->type=="super-admin" )
        {
            $request->validate([
                'image'=>'required|mimes:jpg,png,jpeg|max:1024',
             ]);
     
            $post = Post::findOrFail($id);
    
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

                $c_post=post::findOrFail($id);
    
                // $User->image=$file->getRealPath();
                $c_post->image=url($path,$filename);
                // dd($c_post->image);
    
                $c_post->save();
    
            }

            Post::where('id',$id)->update($request->only($this->column));

            $updated_post = Post::findOrFail($id);

            $updated_post->save();

            return response_data($updated_post,"Post updated successfully");

        }else{

            return response_data("","You are not authorized to perform this action",403);
        }
    
    }

    
    public function update_admin(Request $request ,$id){

        Post::where('id',$id)->update($request->only($this->column_admin));
        $post = Post::findOrFail($id);
        return response()->json([
            "message"=>"Updated successfully (admin)",
            "post"=>$post
        ]);
    }

    public function delete($id){

        // Post::where('id',$id)->delete();
        // return response_data('Post has deleted successfully');
        
        $post=Post::findOrFail($id);
        if($post->user_id==auth()->id() || auth()->user()->type=="super-admin" )
        {
            $post->delete();
            return response_data("",'Post deleted successfully');

        }else{
            return response_data("","You are not authorized to perform this action",403);
        }
    }
    
    public function get_category($category){
        $cat=Post::where("material",$category)->get();
        return response_data($cat,$category." category");

    }
    
    public function savePost($id)
    {
        $user=auth()->user();
        // Find the post by ID
        $post = Post::find($id);

        if (!$post) {

            return response_data("",'Post not found',404);
            
        }

        //make shue user not save same post again
        
        foreach ($user->wishlist as  $value) {
           # code...
            if ($value->post_id == $id) {
            
                // delete $value from database and break loop
                WishList::destroy($value->id);
                return response_data("","This post has been removed from your wishlist.",409);
            }
        }
        
        // Add the post to the user's wishlist
        $wishlistItem = new Wishlist();
        $wishlistItem->user_id = $user->id;
        $wishlistItem->post_id = $id;
        $wishlistItem->save();

        

        return response_data($wishlistItem,'This post has been added to your wishlist',200);

    }

    public function savedPosts()
    {
        // Retrieve saved posts from the database (you can customize this query based on your requirements)

        $wishlist=auth()->user()->wishlist;
        $posts=[];
        foreach ($wishlist as  $value) {
            $post=Post::where('id', $value->post_id)->get();
            array_push($posts,$post[0]);
         }

        return response_data(array_reverse($posts),'Saved posts',200);

    }
    
    // <<<<< Order Processes >>>>>>>>>
    
    public function add_to_chart($id,$buyerID)
    {
        
        // make the all order process from get credit card from the buyer and send it to seller.
        
        // Dispatch the job with the specified delay
        
        $post = Post::find($id);
        $user=User::where('id',$post->user_id)->first();
        
        if (!$post) {
            
            return response_data("",'Post not found',404);
            
        }

        // dd($user->orders);
        
        //make sure user not save same post again
        foreach ($user->orders as  $value) {
            # code...

            if($post->available==False){
                
                return response_data("","The product is not available.",409);
                
            }

            if ($value->post_id == $id) {
                
                
                return response_data("","The order is already in cart .",409);
                
            }
        }
                
        // Add the post to the user's wishlist
        $order_item = new Order();
        $order_item->user_id = $post->user_id;
        $order_item->post_id = $post->id;
        $order_item->seller_id = $post->user_id;
        $order_item->buyer_id = $buyerID;
        $order_item->save();
        
        
        SellerNotification::create([
            "content"=>"You have a new order for your product.",
            "type"=>"new_order",
            "from_who"=>$order_item->buyer_id , 
            "to_who"=>$order_item->seller_id,
            "linked_id"=>$order_item->id
        ]); 
        
        // Find users interested in the material of the new post
        $targetUser = User::where('id',$order_item->seller_id)->get();

        $buyer=User::where('id',$order_item->buyer_id)->get();

        // Send notifications to interested users

        if (!empty($targetUser)) {

            $title = $buyer[0]->name ." Send you a request";
            $body = "A post ".$post->id." has been requested";

            foreach ($targetUser as $user) {
                $this->notificationService->sendNotification($user['fcm_token'], $title, $body);
            }
            
        }
        
        
        return response_data($order_item,'This product has been added to your chart',200);
        
    }
    public function order_process(Request $request , $id){
        
        $order=Order::findOrFail($id);
        
        $request->validate([
            
            'condition'=>'required|string|min:6|max:6'
        ]);
        
        if (!$request->condition or $request->condition=="Reject" or $request->condition=="reject" ){
            
            BuyerNotification::create([
                "content"=>"Your order has been rejected",
                "from_who"=>$order->buyer_id , 
                "to_who"=>$order->seller_id,
                "linked_id"=>$order->id,
                "status"=>"rejected"
            ]);

            // Find users interested in the material of the new post
            $targetUser = User::where('id',$order->buyer_id)->get();

            $seller=User::where('id',$order->seller_id)->get();
            
            // Send notifications to interested users

            if (!empty($targetUser)) {

                $title = $seller[0]->name ." rejects your request";
                $body = "A post ".$order->post_id." has been rejected from the seller";

                foreach ($targetUser as $user) {
                    $this->notificationService->sendNotification($user['fcm_token'], $title, $body);
                }
                
            }
            
            return response_data("","Thank you for responding.",409);
            
        }
        
        if ($request->condition=="Accept" or $request->condition=="accept" ){
            
            $order=Order::findOrFail($id);

            $buyerID=$order->buyer_id;
            $productID=$order->post_id;
            $sellerID=$order->seller_id;
    
            $buyer=User::findOrFail($buyerID);
            $product=Post::findOrFail($productID);
            $seller=User::findOrFail($sellerID);
    
            // check that user if it do the order again to same post , chect if it in transactions table
    
            $check=Transaction::where('sender_id',$buyerID)->where('post_id',$productID)->first();
    
            if($check){
                return response_data("","You have already ordered this product.",409);
            }
                
            if(!$buyer || !$product || !$seller){
                
                return response_data('',"Error in data",400);
            }
            // check if the product is available or not.
    
            if($product== null){
               return response_data('',"The product you are trying to buy is currently unavailable.",400);
            }
    
            // order notification send to seller if it send request accept make  the process continue
                
            // deduct the amount of money from the user balance.
            $balance=$buyer->balance - $product->price ;
    
            User::where('id',$buyer->id )
                 ->update(['balance'=>$balance ]);
    
            // add the price of the product to the sellers account.
    
            $sellers_balance = $seller->balance + $product->price;
    
            User::where('id',$seller->id)
                  ->update([ 'balance'=>$sellers_balance,
                            'commision'=>$sellers_balance*5/100] );   
                            
            
            BuyerNotification::create([
                "content"=>"Your order has been accepted",
                "from_who"=>$buyer->id , 
                "to_who"=>$seller->id,
                "linked_id"=>$product->id,
                "status"=>"accepted"
            ]);  
                  
    
            // save this transaction into transactions table.
            $transaction=Transaction::create([
                "post_id"=>$product->id,
                "sender_id"=>$buyer->id,  
                "receiver_id"=>$seller->id,  
                "amount"=>-$product->price,
                "description"=>'Payment For Product: '.$product->material,
                "transaction_date"=>\Carbon\Carbon::now(),      
                "type"=>2      // type : payment
            ]);        
        
            // Find users interested in the material of the new post
            $targetUser = User::where('id',$buyer->id)->get();

            // Send notifications to interested users

            if (!empty($targetUser)) {

                $title = $seller->name ." accept your request";
                $body = "A post ".$order->post_id." has been accepted and it costs ".$product->price." LE";

                foreach ($targetUser as $user) {
                    $this->notificationService->sendNotification($user['fcm_token'], $title, $body);
                }
                
            }
            
            ConfirmationNotification::create([
                "seller_id"=>$seller->id,
                "buyer_id"=>$buyer->id,
                "order_id"=>$id,
            ]);
    
            return response_data($transaction,'Your Payment has been successfully processed.',200);
            
        }else{
            
            return response_data("","Try again.",409);
            
        }
        
    }
    
    public function process_confimation(Request $request , $order_id){

        $request->validate([
            'condition'=>'required|string|max:6'
        ]);

        $user=auth()->user();

        $order=Order::where("id",$order_id)->get();
        $confirm_notification=ConfirmationNotification::where("order_id",$order_id)->get();
        

        if ($request['condition']=="Yes" || $request['condition']=="yes"){
            
            if ($user->id==$confirm_notification[0]->seller_id){
    
                ConfirmationNotification::where("order_id",$order_id)->update(['seller_response'=>true]) ;
                
                if ($confirm_notification[0]->buyer_response== true){
                    Order::where("id",$order_id)->update(['status'=>'paid']);
                    Post::where("id",$order[0]->post_id)->update(['available'=>False]);
                    ConfirmationNotification::where("order_id",$order_id)->delete();
                    return response_data("","Order successfully delivered");
                }
                return response_data('',"Confirmation Seller done");

            }
            else if ($user->id==$confirm_notification[0]->buyer_id){
    
                ConfirmationNotification::where("order_id",$order_id)->update(['buyer_response'=>true]);
                
                if ($confirm_notification[0]->seller_response== true){
                    Order::where("id",$order_id)->update(['status'=>'paid']);
                    Post::where("id",$order[0]->post_id)->update(['available'=>False]);
                    ConfirmationNotification::where("order_id",$order_id)->delete();
                    return response_data("","Order successfully delivered");
                }
                return response_data('',"Confirmation Buyer done");

            }else{

                return response_data("","There wrong happens",404);
            }

        }else{

            return response_data("","Not confirmed yet from two customers");
        }

    }


    public function chart_orders($buyerID)
    {
        // get orders of buyer user only 
        $order = Order::where('buyer_id',$buyerID)->get();

        $orders=[];
        
        foreach ($order as  $value) {
            $order=Order::where('id', $value->id)->get();

            if ($order[0]['status']=='pending'){
                array_push($orders,$order[0]);
            }
        }

        return response_data(array_reverse($orders),'Chart',200);

    }

    public function buyer_orders_completed($user_id)
    {
        
        // get orders of buyer


        $order = Order::Where('buyer_id',$user_id)
                        ->get();

        $orders=[];
        
        foreach ($order as  $value) {
            $order=Order::where('id', $value->id)->get();

            if ($order[0]['status']=='paid'){
                array_push($orders,$order[0]);
            }
        }

        return response_data(array_reverse($orders),'History',200);

    }

    public function seller_orders_completed($user_id)
    {
        
        // get orders of seller


        $order = Order::where('seller_id',$user_id)
                        ->get();

        $orders=[];
        
        foreach ($order as  $value) {
            $order=Order::where('id', $value->id)->get();

            if ($order[0]['status']=='paid'){
                array_push($orders,$order[0]);
            }
        }

        return response_data(array_reverse($orders),'History',200);

    }
}
