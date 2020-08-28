<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = [
        'title', 'body', 'association_id','date','domain_id'
    ];
    public function association()
    {
        return $this->belongsTo('App\Association');
    }


    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }



    






}
