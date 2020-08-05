<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $tabel='codes';
    protected $primaryKey='id';
    protected $fillable = [
        'code','type','user_id'
    ];
}
