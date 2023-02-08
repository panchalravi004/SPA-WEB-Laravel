<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    protected $table = "COLLEGE_MASTER";
    protected $primaryKey = "COLLEGE_ID";
    public $timestamps = false;
}
