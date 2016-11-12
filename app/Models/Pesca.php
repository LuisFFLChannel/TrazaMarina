<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pesca extends Model
{
    //
    protected $table = 'pesca';
	protected $dates = ['deleted_at'];
}
