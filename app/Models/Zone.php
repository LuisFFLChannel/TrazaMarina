<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    protected $table = 'zones';

    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function seats(){
        return $this->hasMany('App\Models\Seat');
    }

    public function public(){
        return $this->belongToMany('App\Models\Pulic')->withPivot('price');
    }
}