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
         if($type=='donor') {
         
         $donor=Auth::guard('donor')->user()->id;
        $code= DB::select('select code from codes where user_id = :user_id and type = :type' , ['user_id' =>$donor ,'type'=>'donor' ]);
         /* $code=Code::get()->where(['user_id'=>$donor,'type'=>'donor'])->first();
         */
         if($request->code == $code[0]->code){
                $this->donorverify( $donor);
                return redirect()->route('home');

         }
         else{
            flash('X','danger');
             return redirect()->back();
         }
        }
        if($type=='membre') {
         
            $membre=Auth::guard('membre')->user()->id;
           $code= DB::select('select code from codes where user_id = :user_id and type = :type' , ['user_id' =>$membre ,'type'=>'membre' ]);
            /* $code=Code::get()->where(['user_id'=>$donor,'type'=>'donor'])->first();
            */
            if($request->code == $code[0]->code){
                   $this->membreverify( $membre);
                   return redirect()->route('home');
   
            }
            else{
                return redirect()->back();
            }
           }
           if($type=='demandeur') {
         
            $demandeur=Auth::guard('demandeur')->user()->id;
           $code= DB::select('select code from codes where user_id = :user_id and type = :type' , ['user_id' =>$demandeur ,'type'=>'demandeur' ]);
            /* $code=Code::get()->where(['user_id'=>$donor,'type'=>'donor'])->first();
            */
            if($request->code == $code[0]->code){
                   $this->demandeurverify( $demandeur);
                   return redirect()->route('home');
   
            }
            else{
                return redirect()->back();
            }
           }
      }
  











      public function resendcode($type){
        $code = Keygen::numeric(6)->generate();
      
        $basic  = new \Nexmo\Client\Credentials\Basic('1f4fa260', 'qlrHMNC0StbGFvtY');
        $client = new \Nexmo\Client($basic);
    
        $message = $client->message()->send([
          'to' => '213779247735',
          'from' => 'Vonage APIs',
          'text' => 'Givingcom : votre code de verification '.$code
        ]);
        Code::where('user_id',Auth::guard($type)->user()->id)->where('type',$type)->update(['code'=> $code]);
        return redirect()->route('verify',['type'=>$type]);
      }






    protected function donorverify($donor){
    
        Donor::where('id',$donor)->update(['email_verified_at'=> $this->freshTimestamp()]);
    }
    
    protected function membreverify($membre){
    
        Membre::where('id',$membre)->update(['email_verified_at'=> $this->freshTimestamp()]);   

    }
    protected function demandeurverify($demandeur){
    
        Membre::where('id',$demandeur)->update(['email_verified_at'=> $this->freshTimestamp()]);   

    }

  }
