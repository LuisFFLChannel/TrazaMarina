<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frigorifico extends Model
{
    //
    protected $table = 'frigorifico';
	protected $dates = ['deleted_at'];
}
