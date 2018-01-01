<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Contohs extends Model
{
    //use SoftDeletes;

    protected $table      = 'contohs';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];
    //protected $dates      = ['deleted_at'];

}
