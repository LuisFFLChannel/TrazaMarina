<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Embarcacion extends Model
{
    //
    protected $table = 'embarcacion';
	protected $dates = ['deleted_at'];

}
