<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class @MODEL@ extends Model
{
    //use SoftDeletes;

    protected $table      = '@TABLE@';
    protected $primaryKey = '@TABLE_KEY@';
    protected $guarded    = [@COLUMNS_GUARDED@];
    //protected $dates      = ['deleted_at'];

}
