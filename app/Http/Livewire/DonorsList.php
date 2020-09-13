<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Donor;
class DonorsList extends Component
{
    use WithPagination;
    public $query;
    public function render()
    {
        return view('livewire.donors-list',[
            'donors'=>Donor::where('first_name','like','%'.$this->query.'%')->paginate(10)
        ]);
    }
}
