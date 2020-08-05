<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Donor;
use App\Membre;
use App\Demandeur;
use App\Code;

use Twilio\Rest\Client;
use Keygen;
use Auth;
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
    {   if($request->route()->named('donor-register')){
        $mail=Donor::where('email', $request->email)->get();
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
        $credentials = $request->only('email', 'password');
        /*Mail::to($request->email)->send(new DonorVerificationMail(encrypt($request->email),encrypt($request->password)));*/ 
                $token ="6cb055b85632ae620ee945c04f502e09";
                $twilio_sid ="AC76a134ec8d5e62f17952428d9da343f2";
                $twilio_verify_sid ="VA4571b3c7072fdae8c962bf31b6c826aa";
                $twilio_number = +12025191461;
                
                $client = new Client($twilio_sid, $token);
                
                $code = Keygen::numeric(6)->generate();

                $client->messages->create(
                    $request->phone,array('from'=>$twilio_number,'body' => 'Givingcom : votre code de verification '.$code)
                );
                $client->verify->v2->services($twilio_verify_sid)
                    ->verifications;
                    
                Code::create([
                        'code' => $code,
                        'user_id' => $donor->id,
                        'type' => 'donor',
                        ]);
       
        if (Auth::guard('donor')->attempt($credentials)) {
            return view('auth.phonecode');    
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
        
        }}
        else{

        }
    }


    protected function createMembre(RegisterFormRequest $request)
    {
        $mail=Membre::where('email', $request->email)->get();
        $phone=Membre::where('phone', $request->phone)->get();
        if($mail->isEmpty()){
        
        if($phone->isEmpty()){
         Membre::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        ]);
        $credentials = $request->only('email', 'password');
        /*Mail::to($request->email)->send(new DonorVerificationMail(encrypt($request->email),encrypt($request->password)));
                $token ="6cb055b85632ae620ee945c04f502e09";
                $twilio_sid ="AC76a134ec8d5e62f17952428d9da343f2";
                $twilio_verify_sid ="VA4571b3c7072fdae8c962bf31b6c826aa";
                $twilio_number = +12025191461;
                $client = new Client($twilio_sid, $token);
                $client->messages->create(
                    // Where to send a text message (your cell phone?)
                     $request->phone,
                  array(
                'from' => $twilio_number,
                'body' => 'I sent this message in under 10 minutes!'
                   )
               );
                $client->verify->v2->services($twilio_verify_sid)
                    ->verifications;
                    
        
        */
        if (Auth::guard('membre')->attempt($credentials)) {
        /**Notification::send(Auth::guard('donor')->user(),new ResetNotification());**/
        return redirect()->route('membre');
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
         Demandeur::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        ]);
        $credentials = $request->only('email', 'password');
        /*Mail::to($request->email)->send(new DonorVerificationMail(encrypt($request->email),encrypt($request->password)));
                $token ="6cb055b85632ae620ee945c04f502e09";
                $twilio_sid ="AC76a134ec8d5e62f17952428d9da343f2";
                $twilio_verify_sid ="VA4571b3c7072fdae8c962bf31b6c826aa";
                $twilio_number = +12025191461;
                $client = new Client($twilio_sid, $token);
                $client->messages->create(
                    // Where to send a text message (your cell phone?)
                     $request->phone,
                  array(
                'from' => $twilio_number,
                'body' => 'I sent this message in under 10 minutes!'
                   )
               );
                $client->verify->v2->services($twilio_verify_sid)
                    ->verifications;
                    
        
        */
        if (Auth::guard('demandeur')->attempt($credentials)) {
        /**Notification::send(Auth::guard('donor')->user(),new ResetNotification());**/
        return redirect()->route('demandeur');
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
protected function createAdmin(registerFormRequest $request)
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
}
