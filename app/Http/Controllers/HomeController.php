<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
class HomeController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:donor,membre,demandeur,admin,representant');
    }   

    public function index()
    {   $publications=Publication::get();
        return view('home',compact('publications'));
    }

}   
