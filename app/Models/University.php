<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $table = "UNIV_MASTER";
    protected $primaryKey = "UNIV_ID";
    public $timestamps = false;
}
