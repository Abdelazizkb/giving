<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Publication;
use App\Domain;
use App\Category;

class PublicationsList extends Component
{
    use WithPagination;
    public $query;
    public $type;
    public $domain;
    public $category;

    public function render()
    {  
        
        if( $this->type==null)
        $publication=Publication::where('title','like','%'.$this->query.'%')->paginate(6);
        else
        $publication=Publication::where('title','like','%'.$this->query.'%')->where('type',$this->type)->paginate(6);

        if(! $this->domain==null){
            $publication->setCollection($publication->getCollection()->filter(function($publication){
            if($publication->domain_id==$this->domain)
            return true;
            else
            return false;
        }));
    }
    if(! $this->category==null){
        $publication->setCollection($publication->getCollection()->filter(function($publication){
        if($publication->category_id==$this->category)
        return true;
        else
        return false;
    }));
}
        
       
        return view('livewire.publications-list',[
            'publications'=>$publication,
            'domains'=>Domain::get(),
            'categories'=>Category::get()
        ]);
    }
}
