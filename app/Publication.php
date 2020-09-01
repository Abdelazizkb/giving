<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{  
    protected $tabel='publications';

    protected $fillable = [
    'title', 'body', 'publicatable_id','publicatable_type','domain_id','category_id','type','helps','active'
    ];
   
    public function publicatable()
    {
        return $this->morphTo();
    }
    public function domain()
    {
        return $this->belongsTo('App\Domain');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function responses()
    {
        return $this->hasMany('App\Response');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
    
}

