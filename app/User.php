<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //use Authenticatable, CanResetPassword;

    protected $guarded = array('id');

    protected $fillable = array('user_name', 'email', 'confirmation_code');
}
