<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = "FACULTY_OR_TPO_MASTER";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
