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
    'name', 'email', 'password','first_name','last_name','phone','is_super','association_id'
    ];
    protected $hidden = [
    'password', 'remember_token',
    ];


    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
    
    public function code()
    {
        return $this->morphOne('App\Code', 'codeable');
    }
    public function publications()
{
    return $this->morphMany('App\Publication', 'publicatable');
}
public function Response()
{
    return $this->morphMany('App\Response', 'responseable');
}   

public function association()
{
    return $this->belongsTo('App\Association');
}
}
