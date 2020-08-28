<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Representant extends Authenticatable
{
    
    public $tabel='membres';
    public $guard = 'representant';
 
}
