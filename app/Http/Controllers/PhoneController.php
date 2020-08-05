<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhoneController extends Controller
{   
    public function __construct()
    {  
            

    }


    public function showVerificationform(){
      return view('auth.phonecode');
    }






}
