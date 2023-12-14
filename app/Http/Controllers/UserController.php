<?php
namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService\UserLoginService\UserLoginService;
use App\Services\UserService\UserRegisterService\UserRegisterService;


class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:user', ['except' => ['login', 'register','verify_email']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request){

        return(new UserLoginService())->Login($request);


    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request) {

        return(new UserRegisterService())->Register($request);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function verify_email($token) {

        $user = User::where('verificationToken', $token)->update(['status' => 1, 'email_verified_at' => now()]);
        if ($user == null) {
            return response()->json([
                'message'=>'Invalid verification :('
            ],422);
        }
        return response()->json([
            "message" => 'Email successfully verified :D ',
        ]);

    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
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
    public function userProfile() {
        return response()->json(auth()->user());
    }
    public function update(Request $request,$id) {

        $user=User::where('id',$id)->update($request->only(['name','phone_number']));
        $user=User::where('id',$id)->find($id);

        return response()->json([
            "message"=>"User updated successfully",
            "post"=>$user
        ]);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function createNewToken($token){
        return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

}
