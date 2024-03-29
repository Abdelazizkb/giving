<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $tabel='categories';
    public $timestamps=false;
    protected $fillable = [
    'name'
    ];

    public function publications()
    {
        return $this->hasMany('App\Publication');
    }




}
