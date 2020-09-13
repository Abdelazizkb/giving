<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Membre;
class MembresList extends Component
{
    use WithPagination;
    public $query;
    public function render()
    {
        return view('livewire.membres-list',[
            'membres'=>Membre::where('first_name','like','%'.$this->query.'%')->paginate(6)
        ]);
    }
}
