<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Bitfumes\Multiauth\Model\Admin;
class AdminsList extends Component
{
    use WithPagination;
    public $query;
    public function render()
    {
        return view('livewire.admins-list',[
            'admins'=>Admin::where('name','like','%'.$this->query.'%')->where('id', '!=', auth()->id())->paginate(6)
        ]);
    }
}
