<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Membre extends Authenticatable
{
    use Notifiable;
    protected $tabel='membres';
    protected $guard = 'membre';
    protected $primaryKey='id';
    protected $fillable = [
    'name', 'email', 'password','first_name','last_name','phone'
    ];
    protected $hidden = [
    'password', 'remember_token',
    ];


    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
    
    
}
