<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Donor;
use App\Membre;
use App\Demandeur;
use App\Publication;

class profileController extends Controller
{
 
    public function __construct()
    {   
        $this->middleware('auth:donor,membre,demandeur,admin');
    }   

public function index(){
   /* if($type=='donor'){
    $user=Donor::where('id',$id)->first();
    }
    if($type=='membre'){
        $user=Membre::where('id',$id)->first();
    }
    if($type=='demandeur'){
        $user=Demandeur::where('id',$id)->first();
    }*/
    $user=Auth::user();
    return view('profile',compact('user'));
}

public function profile($user){
    
     $user=Publication::where('id',$user)->first()->publicatable;
     return view('profile',compact('user'));
 }


}
