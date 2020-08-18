<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{   
    
    protected $fillable = [
        'body', 'publication_id','responseable_type','responseable_id'
        ];
    
    public function responseable()
    {
        return $this->morphTo();
    }

    public function publication()
    {
        return $this->belongsTo('App\Publication');
    }
}
