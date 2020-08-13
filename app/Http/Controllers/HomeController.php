<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:donor,membre,demandeur,admin,representant');
    }   

    public function index()
    {
        return view('home');
    }

}   
