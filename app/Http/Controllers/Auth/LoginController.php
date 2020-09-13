<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use Auth;
use App\Membre;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware(['guest','guest:donor','guest:admin','guest:membre','guest:demandeur'])->except('logout');
    }


    

     public function login(LoginFormRequest $request,$type)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        
            // Authentication passed...
       
            $active=Db::select("select is_active from ".$type."s   where phone =".$request->phone);


        // verifie si il est bloque    
       if(! $active[0]->is_active){
        return redirect()->back();

       }

        if ($this->attemptLogin($request,$type) ) {
   
            $this->representantLogin($type,Auth::guard($type)->user(),$request);
            return redirect()->route('home');
             
        }
        

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    
     protected function attemptLogin(Request $request,$type)
    {
        return Auth::guard($type)->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

     public function username()
    {
        return 'phone';
    }



     public function logout(Request $request)
    {   

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }
    protected function representantLogin($type ,$user,$request){
        if($type=='membre' and $user->is_super==1 ){
    
        $credentials = $request->only('phone', 'password');

        Auth::guard('representant')->attempt($credentials);
        }
    }

}
