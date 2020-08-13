<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Auth;
Use App\Donor;
use App\Membre;
use App\Demandeur;
use App\Code;
use Keygen;

class verifyController extends Controller
{   
    use HasTimestamps;
    







    public function __construct()
    {   
        $this->middleware('auth:donor,membre,demandeur,admin');
    }  
    








    public function verifyForm($type){
        return view('auth.phonecode',compact('type'));
      }
  
      public function verify(Request $request,$type){
        $code= Auth::guard($type)->user()->code->code;

         if($request->code == $code){
               $user= Auth::guard($type)->user();
                $user->email_verified_at=$this->freshTimestamp();
                $user->save();
                return redirect()->route('home');

         }
         else{
             return redirect()->back();
         }
        
        
      }
  













      public function resendcode($type){
        $code = Keygen::numeric(6)->generate();
      
        $basic  = new \Nexmo\Client\Credentials\Basic('1ebd6fa8', 'gx9J1TgFE0a5sN3Z');
        $client = new \Nexmo\Client($basic);
    
       /* $message = $client->message()->send([
          'to' => '213541259036',
          'from' => 'Vonage APIs',
          'text' => 'Givingcom : votre code de verification '.$code
        ]);
        $u_code=Auth::user()->code;
        $u_code->code=$code;
        $u_code->save();*/
        return redirect()->route('verify',['type'=>$type]);
      }





  }
