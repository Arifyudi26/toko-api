<?php

namespace App\Models;

use Illuminate\Database\Eloquent\model;

class Login extends Model
{
    protected $table = "Member Token";
    protected $fillable = ['member_id', 'auth_key'];
    public $timestamps = false;
}