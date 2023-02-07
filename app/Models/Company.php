<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = "COMPANY_MASTER";
    protected $primaryKey = "COMPANY_ID";
    public $timestamps = false;
}
