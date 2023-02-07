<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "STUDENT_MASTER";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
