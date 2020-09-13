<?php

namespace App\Http\Controllers;

use App\Annonce;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use App\Http\Requests\CreateAnonceRequest;
use App\Domain;
use App\Category;
use Auth;
use Str;
use Flashy;
use App\Image;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use HasTimestamps;


    public function __construct()
    {   
        $this->middleware('auth:donor,membre,demandeur,admin');
        $this->middleware('auth:representant')->except(['index','show','participate']);

    }   

    public function index()
    { 
      $annonces=Annonce::where('active',1)->get();
      return view('annonce.index',compact('annonces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();
        $domains=Domain::get();
        return view('annonce.create',compact(['categories','domains']));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnonceRequest $request)
    {          $domain=Domain::firstOrCreate(['name'=>$request->domain]); 

        $annonce=Annonce::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'domain_id'=>$domain->id,
            'date'=>$request->date,
            'association_id'=>Auth::guard('membre')->user()->association->id
            ]);

      if($request->hasFile('image')){
        $destination='public';
        $image=$request->file('image');
   
        $path=$request->file('image')->store($destination);
      
        $path=Str::substr($path, 7);
        Image::Create(['image'=>$path,'imageable_id'=>$annonce->id,'imageable_type'=>'App\Annonce']);   
    }
   
    Flashy::success('La annonce a été publiée');
    return redirect()->back();
   /*   return redirect()->route('publication.show',compact('publication')); 
*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        return view('annonce.show',compact('annonce'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
       return view('annonce.update',compact('annonce'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        $annonce->title=$request->title;
     $annonce->body=$request->body;
     $annonce->save();
     if($request->hasFile('image')){
        $destination='public';
        $image=$request->file('image');
   
        $path=$request->file('image')->store($destination);
   
        $path=Str::substr($path, 7);
        $image=$annonce->image;
        $image->image=$path;
        $image->save();
    }
   
   
    Flashy::success("L'annonce a été mise à jour");

    return redirect()->route('annonce.show',['annonce'=>$annonce]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        Flashy::success('La publication a été supprimée');

        $annonce->delete();
         return redirect()->route('annonce.index');
    }

    public function participate($annonce){
        $annonce=Annonce::where('id',$annonce)->first();
        $annonce->participers=$annonce->participers+1;
        $annonce->save();
       return redirect()->back();   
      }
}
