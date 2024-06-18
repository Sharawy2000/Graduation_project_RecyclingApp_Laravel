<?php
namespace App\Http\Controllers;
use App\Http\Middleware\CheckLang;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SellerNotification;
use App\Models\BuyerNotification;
use App\Models\ConfirmationNotification;
use App\Services\UserService\UserLoginService\UserLoginService;
use App\Services\UserService\UserRegisterService\UserRegisterService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:user', ['except' => ['login', 'register','verify_email']]);
        $this->middleware(CheckLang::class);
    }
    
    public function login(LoginRequest $request){

        return(new UserLoginService())->Login($request);

    }

    public function register(RegisterRequest $request) {

        return(new UserRegisterService())->Register($request);
    }

    
    public function verify_email($token) {
        
        $user = User::where('verificationToken', $token)->update(['status' => 1, 'email_verified_at' => now()]);
        
        if ($user == null) {
            return response_data("",__('auth.notVerified'),422);
            
        }
        return view('emails.mailVerified');
        
    }
    public function FCMTokenController(Request $request) {
        
        $user = auth()->user(); // Assuming user is authenticated
        $user->fcm_token = $request->input('token');
        $user->save();

        return response_data($user,'FCM token stored successfully',200);
        
    }
    
    /**
     * Log the user out (Invalidate the token).
     *
//     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response_data("",__('auth.logout'));
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile($id) {
        $user=User::where('id',$id)->first();
        return response_data($user,"");

    }
    public function show_posts(){
        
        $user=auth()->user();
        $posts = $user->posts;
        
        return response_data($posts,"");
    }
    public function show_seller_notifications(){
        $user=auth()->user();
        $notifications = SellerNotification::where('to_who', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response_data($notifications,"Seller Notifications");
    }
    public function show_buyer_notifications(){
        $user=auth()->user();
        $notifications = BuyerNotification::where('from_who', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response_data($notifications,"Buyer Notifications");
    }
    public function buyer_confirm_notification(){
        $user=auth()->user();
        $confirm_notification = ConfirmationNotification::where('buyer_id',$user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return response_data($confirm_notification,"Confirm Notifications");
    }
    public function seller_confirm_notification(){
        $user=auth()->user();
        $confirm_notification = ConfirmationNotification::where('seller_id',$user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return response_data($confirm_notification,"Confirm Notifications");
    }

    public function update(Request $request , $id) {
        $validator=Validator::make($request->all(),[
            'name'=>'nullable|String|max:50',
            "phone_number"=>'nullable|min:11|max:11|unique:users',
            "address"=>'nullable|String|max:50',
            "image"=>'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "governorate"=>'nullable|String|max:30',
            "city"=>'nullable|String|max:30',
            "street"=>'nullable|String|max:60',
            "residential_quarter"=>'nullable|String|max:60',
            "TIN"=>'nullable|digits:9|unique:users,TIN,',
            "organization"=>'nullable|string|max:30',
            "interests"=>'nullable|string|max:255',
            "balance"=>'nullable|integer',
            "commision"=>'nullable|integer'
        ]);

        if(!$validator->fails()) {
            $User=User::findOrFail($id);
            $User->update($request->all());

            return response_data($User,__('auth.update'));
        }else{

            return response_data("",$validator->errors(),422);
        
       }


    }
    public function update_profileIMG(Request $request) {

        $request->validate([
           'image'=>'required|mimes:jpg,png,jpeg|max:1024',
        ]);

        $user = auth()->user();
        $img=$user['image'];

        if ($request->hasFile('image')) {

            // image check 
            if ($img) {
                $path='images/ProfileImage/'.$img;
                Storage::disk('public')->delete($path);
            }
            // image  uploading
            $file=$request->file('image');
            $extension = $file -> getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path='images/ProfileImage';
            $file->move(public_path($path) , $filename);
            $User=User::findOrFail($user->id);

            $User->image=url($path,$filename);

            $User->save();

            return response_data($User,__('auth.update'));

        }


        return response_data('','failed',400);
 
        
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function createNewToken($token){

        return response_data([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60000,
        ],'');

    }

}
