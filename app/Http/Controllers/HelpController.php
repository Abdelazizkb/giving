<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationMail;
use App\Mail\DemandeMail;
use App\Publication;
use Auth;
class HelpController extends Controller
{

public function help($publication){
  $pub=Publication::where('id',$publication)->first();
  $pub->helps=$pub->helps+1;
  $pub->save();
   Mail::to('korbaabdo@gmail.com')->send(new DonationMail($publication));
 return redirect()->back();   
}
public function take($publication){
  $pub=Publication::where('id',$publication)->first();
  $pub->helps=$pub->helps+1;
  $pub->save();
  Mail::to('korbaabdo@gmail.com')->send(new DemandeMail($publication));
 return redirect()->back();   
}



}
