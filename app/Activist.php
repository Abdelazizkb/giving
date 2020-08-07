<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activist extends Model
{   protected $fillable = [
       'first_name', 'email', 'phone','association_id','last_name',
    ];
   
    public $timestamps=false;
    
    
    public function association(){
        return $this->belongsTo('App\Association');
    }

}
