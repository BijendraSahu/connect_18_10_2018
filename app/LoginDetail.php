<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginDetail extends Model
{
    protected $table = 'login_details';
    public $timestamps = false;
    protected  $primaryKey ='login_details_id';
}
