<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelians extends Model
{
    //use SoftDeletes;

    protected $table      = 'pembelians';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];
    //protected $dates      = ['deleted_at'];

}
