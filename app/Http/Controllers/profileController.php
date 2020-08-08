<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class profileController extends Controller
{
 
    public function __construct()
    {   
        $this->middleware('auth:donor,membre,demandeur,admin');
    }   

public function index(){
    return view('profile');
}



}
