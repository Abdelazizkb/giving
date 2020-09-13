<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Demandeur;
class DemandeursList extends Component
{
    use WithPagination;
    public $query;
    public function render()
    {
        return view('livewire.demandeurs-list',[
            'demandeurs'=>Demandeur::where('first_name','like','%'.$this->query.'%')->paginate(6)
        ]);
    }
}
