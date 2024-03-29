<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    protected $fillable = [
        'name', 'email', 'phone','country','adress','domain'
        ];
    public $timestamps=false;

    public function activists(){
        return $this->hasMany('App\Activist');
        }
    public function membres(){
        return $this->hasMany('App\Membre');
     }
 
     public function annonces()
     {
         return $this->hasMany('App\Annonce');
     }
     
     public function image()
     {
         return $this->morphOne('App\Image', 'imageable');
     }





}
