<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
     protected $tabel='domains';
     public $timestamps=false;

    protected $fillable = [
    'name'
    ];
    public function publications()
    {
        return $this->hasMany('App\Publication');
    }
}
