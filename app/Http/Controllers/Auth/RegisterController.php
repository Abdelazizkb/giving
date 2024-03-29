<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Donor;
use App\Activist;
use App\Association;
use App\Membre;
use App\Demandeur;
use App\Code;
use App\Image;
use File;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Twilio\Rest\Client;
use Keygen;
use Auth;
use Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\registerFormRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


       public function showRegistrationForm()
    {   
        $associations=Association::all();
        return view('auth.register',compact('associations'));
    }
   /* public function showAdminRegisterForm()
    {
        return view('auth.adminregister');
    }

*/


    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }




    protected function createDonor(RegisterFormRequest $request)
    {   
        

       // verifier si l'email est deja utilise 

        $mail=Donor::where('email', $request->email)->get();

        // verifier si le telephone est deja utilise 
 
        $phone=Donor::where('phone', $request->phone)->get();
        if($mail->isEmpty()){
        
        if($phone->isEmpty()){
        $donor=Donor::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        ]);

       
        
     
        //makeing profile picture

        if($request->hasFile('image')){
            $destination='public';
            $image=$request->file('image');
       
            $path=$request->file('image')->store($destination);
        }
       
        $path=Str::substr($path, 7);
        Image::Create(['image'=>$path,'imageable_id'=>$donor->id,'imageable_type'=>'App\Donor']);
        
        // send confermation sms
        $this->nexmo($donor,'App\Donor');  



        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('donor')->attempt($credentials)) {
            return redirect()->route('verify',['type'=>'donor']);    
        }
        }
        else{
        flash('numero telephone deja utiliser','danger');
        return redirect()->back();
        }
        
        }
        else{
        flash('email deja utiliser','danger');
        return redirect()->back();
        
        }
     
        }
    


    protected function createMembre(RegisterFormRequest $request)
    {    
        $activist= Activist::whereEmail($request->email)->get();
          if ($activist->isEmpty()) {
	          flash("Le membre n'existe pas ",'danger');
              return redirect()->back();
           }
         if(! ""+$activist->first()->association_id === $request->association ){
             flash("Le membre n'existe pas  dans l'association donnee , vous devez verifier l'association selectionnee ",'danger');
             return redirect()->back();
          }




        $mail=Membre::where('email', $request->email)->get();
        $phone=Membre::where('phone', $request->phone)->get();
        if($mail->isEmpty()){
        if($phone->isEmpty()){
        $membre= Membre::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_super'=>$activist->first()->is_super,
        'association_id'=>$activist->first()->association_id,
        ]);
        //makeing profile picture

       if($request->hasFile('image')){
        $destination='public';
        $image=$request->file('image');
   
        $path=$request->file('image')->store($destination);
         }
   
        $path=Str::substr($path, 7);
        Image::Create(['image'=>$path,'imageable_id'=>$membre->id,'imageable_type'=>'App\Membre']);
    
        // send confermation sms

       $this->nexmo($membre,'App\Membre');  
        
        $credentials = $request->only('email', 'password');

        if (Auth::guard('membre')->attempt($credentials)) {
        /**Notification::send(Auth::guard('donor')->user(),new ResetNotification());**/
        if($membre->is_super)
        Auth::guard('representant')->attempt($credentials);

        return redirect()->route('verify',['type'=>'membre']);    
    }
        }
        else{
        flash('numero telephone deja utiliser','danger');
        return redirect()->back();
        }
        
        }
        else{
        flash('email deja utiliser','danger');
        return redirect()->back();
        
        }
    }


    protected function createDemandeur(RegisterFormRequest $request)
    {
        $mail=Demandeur::where('email', $request->email)->get();
        $phone=Demandeur::where('phone', $request->phone)->get();
        if($mail->isEmpty()){
        
        if($phone->isEmpty()){
        $demandeur=Demandeur::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        ]);
       
        
        
        //makeing profile picture

       if($request->hasFile('image')){
        $destination='public';
        $image=$request->file('image');
   
        $path=$request->file('image')->store($destination);
         }
   
        $path=Str::substr($path, 7);
        Image::Create(['image'=>$path,'imageable_id'=>$demandeur->id,'imageable_type'=>'App\Demandeur']);
    
        // send confermation sms

        $this->nexmo($demandeur,'App\Demandeur');      
        
        $credentials = $request->only('email', 'password');

        if (Auth::guard('demandeur')->attempt($credentials)) {
        /**Notification::send(Auth::guard('donor')->user(),new ResetNotification());**/
        return redirect()->route('verify',['type'=>'demandeur']);    
         }
        }
        else{
        flash('numero telephone deja utiliser','danger');
        return redirect()->back();
        }
        
        }
        else{
        flash('email deja utiliser','danger');
        return redirect()->back();
        
        }
    }
/*protected function createAdmin(registerFormRequest $request)
{

$admin=Admin::where('email', $request->email)->get();
if($admin->isEmpty()){
Admin::create([
'name' => $request->name,
'email' => $request->email,
'password' => Hash::make($request->password),
]);
$credentials = $request->only('email', 'password');
if (Auth::guard('admin')->attempt($credentials)) {
return redirect()->back();
}    }
else{
flash('email deja utiliser','danger');
return redirect()->back();
}
}
*/
protected function nexmo($user,$type){
    $code = Code::firstOrCreate(['codeable_type'=>$type,'codeable_id'=>$user->id ],
    ['code' => Keygen::numeric(6)->generate()]
    );

  /*  $basic  = new \Nexmo\Client\Credentials\Basic('1ebd6fa8', 'gx9J1TgFE0a5sN3Z');
    $client = new \Nexmo\Client($basic);

    $message = $client->message()->send([
      'to' => '213541259036',
      'from' => 'Vonage APIs',
      'text' => 'Givingcom : votre code de verification '.$code
    ]);
    
  */

}
}
