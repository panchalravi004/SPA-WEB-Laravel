<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $table = "LOGIN_MASTER";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
