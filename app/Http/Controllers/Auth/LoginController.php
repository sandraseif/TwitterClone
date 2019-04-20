<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
    * This function authenticates the user by email and password,
    * creates a new api_token for validated user, saves it
    * in the database and returns back the user
    */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }
    /*
    * This function will get the authenticated user
    * unset and save the api token
    */
    public function logout(Request $request)
    {   
      
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        Auth::logout();
        return redirect('/login');
        //$this->sendResponse(null,"Successfully Logged Out"); 
    }
     public function logoutAPI()
    {      
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        $this->sendResponse(null,"Successfully Logged Out"); 
    }
}
