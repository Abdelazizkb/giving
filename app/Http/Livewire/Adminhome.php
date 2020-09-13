<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Donor;
use App\Demandeur;
use App\Annonce;
use App\Membre;
use App\Publication;
use App\Response;
use DateTime;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Adminhome extends Component
{
    use HasTimestamps;

    public $publication;
    public $demandeur;
    public $donor;
    public $annonce;
    public $membre;
    public $response;
    public $demande_helped;

    public function render()
    { 
        
      $this->publication=[
             'new'=>Publication::where('created_at', '>=', new DateTime('today'))->count(),
             'all'=>Publication::get()->count(),

             'donation'=>Publication::where('type','donation')->count(),
             'demande'=>Publication::where('type','demande')->count(),


             'new_donation'=>Publication::where('created_at', '>=', new DateTime('today'))->where('type','donation')->count(),
             'new_demande'=>Publication::where('created_at', '>=', new DateTime('today'))->where('type','demande')->count(),


                ];

      $this->demandeur=[
            'new'=>Demandeur::where('created_at', '>=', new DateTime('today'))->count(),
            'all'=>Demandeur::get()->count(),
           ]; 

      $this->annonce=[
           'new'=>Annonce::where('created_at', '>=', new DateTime('today'))->count(),
           'all'=>Annonce::get()->count(),
        ];  
      
      
      $this->membre=[
          'new'=>Membre::where('created_at', '>=', new DateTime('today'))->count(),
          'all'=>Membre::get()->count(),
        ];

      $this->donor=[
        'new'=>Donor::where('created_at', '>=', new DateTime('today'))->count(),
        'all'=>Donor::get()->count(),
          ];
      $this->response=[
            'new'=>Response::where('created_at', '>=', new DateTime('today'))->count(),
            'all'=>Response::get()->count(),
              ];
       //calcule percentage de demande qu'il sont deja pris en charge   
            $demande=Publication::where('type','demande')->count();
             $helped=Publication::where('type','demande')->where('helps','>',0)->count();
            
           if(! $helped==0){  
           $this->demande_helped=($demande/$helped)*100;
           }
           else
           $this->demande_helped=0;
           
        return view('livewire.adminhome',[
        'donor'=>$this->donor,
        'annonce'=> $this->annonce,
        'membre' =>$this->membre,
        'publication'=>$this->publication,
        'demandeur'=>$this->demandeur,
        'response'=>$this->response,
         'demande'=>$this->demande_helped
        ]);



    }
}
