<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use App\Annonce;
use App\Domain;

class HomeController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:donor,membre,demandeur,representant');
    }   

    public function index()
    {   $annonces=Annonce::limit(5)->where('active',1)->get();
        $domains=Domain::get();
        return view('home',compact('annonces','domains'));
    }






}   
