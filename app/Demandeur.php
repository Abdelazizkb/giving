<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Demandeur extends Authenticatable
{
    use Notifiable;
protected $tabel='demadeurs';
protected $guard = 'demadeur';
protected $primaryKey='id';
protected $fillable = [
'name', 'email', 'password','first_name','last_name','phone'
];
protected $hidden = [
'password', 'remember_token',
];
}
