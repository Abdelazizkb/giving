<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {  
      
        $this->middleware('auth:admin');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  
    public function donors()
    {
        return view('vendor.multiauth.users.donors');
    }
    public function membres()
    {
        return view('vendor.multiauth.users.membres');
    }
    public function demandeurs()
    {
        return view('vendor.multiauth.users.demandeurs');
    }
    public function publications()
    {
        return view('vendor.multiauth.posts.publications');
    }
    public function annonces()
    {
        return view('vendor.multiauth.posts.annonces');
    }

    
    public function deactivate($type,$id)
    {  if($type=='annonces' or $type=='publications')
        $column='active';
        else
        $column='is_active';

        Db::update("update ".$type." set ".$column." = ". 0 ."  where id =".$id);
        return redirect()->back();
    }



    public function activate($type,$id)
    {  if($type=='annonces' or $type=='publications')
        $column='active';
        else
        $column='is_active';

        $s=Db::update("update ".$type." set ".$column." = ". 1 ."  where id =".$id);

        return redirect()->back();
    }

}
