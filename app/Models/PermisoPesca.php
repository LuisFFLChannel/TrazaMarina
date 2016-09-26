<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermisoPesca extends Model
{
    //
    protected $table = 'permisopesca';
	protected $dates = ['deleted_at'];
}
