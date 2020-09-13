<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Annonce;
class AnnoncesList extends Component
{
    use WithPagination;
    public $query;
    public function render()
    {
        return view('livewire.annonces-list',[
            'annonces'=>Annonce::where('title','like','%'.$this->query.'%')->paginate(6)
        ]);
    }
}
