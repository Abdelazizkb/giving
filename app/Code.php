<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $tabel='codes';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable = [
        'code','codeable_type','codeable_id'
    ];
    public function codeable()
    {
        return $this->morphTo();
    }
}
