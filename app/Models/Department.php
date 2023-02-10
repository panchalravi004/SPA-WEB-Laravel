<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = "DEPT_MASTER";
    protected $primaryKey = "DEPT_ID";
    public $timestamps = false;

    protected $fillable = ['DEPT_NAME'];
    
}
