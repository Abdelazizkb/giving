<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Donor extends Authenticatable
{
    use Notifiable;
    protected $tabel='donors';
protected $guard = 'donor';
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
public function code()
{
    return $this->morphOne('App\Code', 'codeable');
}
public function publications()
{
    return $this->morphMany('App\Publication', 'publicatable');
}
    
}
