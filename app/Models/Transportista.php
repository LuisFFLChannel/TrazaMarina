<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transportista extends Model
{
    //
    protected $table = 'transportista';
	protected $dates = ['deleted_at'];
}
