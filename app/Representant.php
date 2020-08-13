<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Representant extends Authenticatable
{
    
    protected $tabel='membres';
    protected $guard = 'representant';
 
}
