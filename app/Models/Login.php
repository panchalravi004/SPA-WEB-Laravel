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

    protected $fillable = [
        'USER_ID',
        'USER_ROLE',
        'USER_PASS',
        'USER_EMAIL',
        'USER_STATUS'
    ];
}
