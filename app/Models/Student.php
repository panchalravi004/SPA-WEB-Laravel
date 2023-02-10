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

    protected $fillable = [
        'STUD_ID',
        'STUD_NAME',
        'STUD_PHOTO',
        'STUD_GENDER',
        'STUD_MOB',
        'STUD_ADDRESS',
        'CITY_ID',
        'PRIMARY_SKILL',
        'SECONDARY_SKILL',
        'TERTIARY_SKILL',
        'STUD_RESUME',
        'UNIV_ID',
        'COLLEGE_ID',
        'DEPT_ID',
        'ACADEMIC_SESSION',
        'SESSION_START_MONTH',
        'SEM',
        'ACADEMIC_LEVEL',
        'SSC_SCORE',
        'SSC_PASS_YR',
        'HSC_SCORE',
        'HSC_STREAM',
        'HSC_PASS_YR',
        'UG_SCORE',
        'UG_STRAM',
        'UG_PASS_YR',
        'PG_SCORE',
        'PG_STREAM',
        'PG_PASS_YR',
        'CAN_UPDATE_SEM_RESULT',
        'CAN_UPDATE_PROFILE',
        'RECORD_CREATED',
        'RECORD_UPDATED',
        'UPDATER_ID',
        'SECTION',
        'STUD_DOB'
    ];
}
