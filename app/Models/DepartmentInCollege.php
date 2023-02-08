<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentInCollege extends Model
{
    use HasFactory;

    protected $table = "COLLEGE_DEPT_MASTER";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
