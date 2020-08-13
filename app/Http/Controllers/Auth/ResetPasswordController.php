<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\resetFormRequest;
use App\Donor;
use App\Membre;
Use App\Demandeur;
use App\Code;
use Illuminate\Http\Request;
use Keygen;
use Auth;
use Hash;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;





public function confirm(Request $request,$type){
        $code='0';
        if($type=='donor') {  
        $user= Donor::get()->where('phone',$request->phone)->first();       
        
        }
        if($type=='membre')  {
        $user= Membre::where('phone',$request->phone)->first();
        }
        if($type=='demandeur') {
        $user=Demandeur::where('phone',$request->phone)->first();
        }  
        if($request->code == $user->code->code){          
           return redirect()->route('password-reset-form',['phone'=>$request->phone,'type'=>$type]);
         }
        else{
            return view('auth.passwords.confirm', compact(['user','type']));
        }
           
    }






public function search(Request $request,$type){
$user='';
if($type=='donor'){
 $user=Donor::wherePhone($request->phone)->first(); 
 $morphetype='App\Donor';
}
if($type=='demandeur'){
    $user=Demandeur::wherePhone($request->phone)->first(); 
    $morphetype='App\Demandeur';
}
if($type=='membre'){
    $user=Membre::wherePhone($request->phone)->first(); 
    $morphetype='App\Membre';

}
if($user=='')
return redirect()->back();

$this->nexmo($user,$morphetype); 
return view('auth.passwords.confirm', compact(['user','type']));
}



public function reset(resetFormRequest $request ){
    $user='';
    if($request->type=='donor')
    $user=Donor::where('phone',$request->phone)->first();    
    if($request->type=='demandeur')
    $user=Demandeur::where('phone',$request->phone)->first();
    if($request->type=='membre')
    $user=Membre::where('phone',$request->phone)->first();
    
    if($user=='')
    return redirect()->back();

    $user->fill([
        'password' => Hash::make($request->password)
    ])->save();


    
    $credentials = $request->only('phone', 'password');
    Auth::guard($request->type)->attempt($credentials );
    return redirect()->home();

  }


public function showResetForm($type,$phone){
    return view('auth.passwords.reset',['phone'=> $phone ,'type'=>$type]);
}







protected function nexmo($user,$type){
   
    $code=Code::firstOrCreate(['codeable_type'=>$type,'codeable_id'=>$user->id ],
                           ['code' => Keygen::numeric(6)->generate()]
                           );

   /* $basic  = new \Nexmo\Client\Credentials\Basic('1f4fa260', 'qlrHMNC0StbGFvtY');
    $client = new \Nexmo\Client($basic);

    $message = $client->message()->send([
      'to' => '213779247735',
      'from' => 'Vonage APIs',
      'text' => 'Givingcom : votre code de verification '.$code->code
    ]);
  */
    }


    protected function attemptLogin($request,$type)
    {
        return Auth::guard($type)->attempt($request );
    }

}
