<?php

namespace App\Http\Controllers;

use App\Association;
use Illuminate\Http\Request;
use Str;
use Flashy;
use App\Image;

class AssociationController extends Controller
{



    public function __construct()
    {   
        $this->middleware('auth:donor,membre,demandeur,admin,representant');
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Association  $association
     * @return \Illuminate\Http\Response
     */
    public function show(Association $association)
    {
        return view('association.show',compact('association'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Association  $association
     * @return \Illuminate\Http\Response
     */
    public function edit(Association $association)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Association  $association
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Association $association)
    {
      if(! $association->image == null ){
        if($request->hasFile('image')){
            $destination='public';
            $image=$request->file('image');
       
            $path=$request->file('image')->store($destination);
       
            $path=Str::substr($path, 7);
            $image=$association->image;
            $image->image=$path;
            $image->save();
        }
       
      }
      if($request->hasFile('image')){
        $destination='public';
        $image=$request->file('image');
   
        $path=$request->file('image')->store($destination);
      
        $path=Str::substr($path, 7);
        Image::Create(['image'=>$path,'imageable_id'=>$association->id,'imageable_type'=>'App\Association']);   
    }
   
    Flashy::success("L'image a été modifiée");
    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Association  $association
     * @return \Illuminate\Http\Response
     */
    public function destroy(Association $association)
    {
        //
    }
}
