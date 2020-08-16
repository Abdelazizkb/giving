<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePublicationRequest;

use App\Domain;
use App\Category;
use Auth;
use Str;
use Flashy;
use App\Image;

class PublicationController extends Controller
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
    {   $categories=Category::get();
        $domains=Domain::get();
        return view('publication.create',compact(['categories','domains']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePublicationRequest $request)
    {
       
      $publication=Publication::create([
      'title'=>$request->title,
      'body'=>$request->body,
      'domain_id'=>$request->domain,
      'category_id'=>$request->category,
      'publicatable_type'=> ($this->publicatable_Type()),
      'publicatable_id'=>Auth::user()->id
      ]);


      if($request->hasFile('image')){
        $destination='public';
        $image=$request->file('image');
   
        $path=$request->file('image')->store($destination);
      
        $path=Str::substr($path, 7);
        Image::Create(['image'=>$path,'imageable_id'=>$publication->id,'imageable_type'=>'App\Publication']);   
    }
   
    Flashy::success('La publication a été créée');

      return redirect()->route('publication.show',compact('publication')); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publications  $publications
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
      $type= $this->type(); 
   return view('publication.show',compact('publication','type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publications  $publications
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        return view('publication.update',compact('publication'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publications  $publications
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePublicationRequest $request, Publication $publication)
    {
     $publication->title=$request->title;
     $publication->body=$request->body;
     $publication->save();
     if($request->hasFile('image')){
        $destination='public';
        $image=$request->file('image');
   
        $path=$request->file('image')->store($destination);
   
        $path=Str::substr($path, 7);
        $image=$publication->image;
        $image->image=$path;
        $image->save();
    }
   
   
    Flashy::success('La publication a été mise à jour');

    return redirect()->route('publication.show',['publication'=>$publication]);
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publications  $publications
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
    Flashy::success('La publication a été supprimée');

    $publication->delete();
     return redirect()->home();
    }


    protected function publicatable_Type(){
        if(Auth::guard('donor')->check())
        return 'App\Donor';
        if(Auth::guard('membre')->check())
        return 'App\Membre';
        if(Auth::guard('demandeur')->check())
        return 'App\Demandeur';

    }

    protected function type(){
        if(Auth::guard('donor')->check())
        return 'donor';
        if(Auth::guard('membre')->check())
        return 'membre';
        if(Auth::guard('demandeur')->check())
        return 'demandeur';

    }
}
