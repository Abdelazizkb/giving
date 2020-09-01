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
    {   $annonces=Annonce::limit(5)->get();
        $publications=Publication::get();
        $domains=Domain::get();
        return view('home',compact('publications','annonces','domains'));
    }






}   
