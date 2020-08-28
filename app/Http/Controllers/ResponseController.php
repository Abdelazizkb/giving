<?php

namespace App\Http\Controllers;

use App\Response;
use Illuminate\Http\Request;
use Auth;
use Flashy;
class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {   
        $this->middleware('auth:donor,membre,demandeur,admin,representant');
    }   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response=Response::create([
            'body'=>$request->body,
            'responseable_id'=>Auth::user()->id,
            'responseable_type'=> ($this->publicatable_Type()),
            'publication_id'=>$request->id
            ]);
            return redirect()->back();
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    { 
      
      $response->body=$request->body;
      $response->save();
      Flashy::success('Le commentaire a été modifiee');
      return redirect()->back(); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        Flashy::success('Le commentaire a été supprimée');

        $response->delete();
         return redirect()->back();

    }


    protected function publicatable_Type(){
        if(Auth::guard('donor')->check())
        return 'App\Donor';
        if(Auth::guard('membre')->check())
        return 'App\Membre';
        if(Auth::guard('demandeur')->check())
        return 'App\Demandeur';

    }



}
