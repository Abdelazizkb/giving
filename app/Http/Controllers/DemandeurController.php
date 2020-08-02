<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemandeurController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {  
       
        $this->middleware('auth:demandeur');
     

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('demandeur');
    }
}
