<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Login;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    *
    *
    */
    

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.stud_id' => 'required|unique:LOGIN_MASTER,USER_ID',
        ])->validate();
        
        foreach ($rows as $row) {
            $role = "STUDENT";
            
            Login::create([
                'USER_ROLE' => $role,
                'USER_ID' => $row['stud_id'],
                'USER_PASS' => md5(date("d-m-Y", strtotime($row['stud_dob']))),
                'USER_EMAIL' => $row['user_email'],
                'USER_STATUS' => 0
            ]);

            Student::create([
                "STUD_ID" => $row['stud_id'],
                "STUD_NAME" => $row['stud_name'],
                "STUD_GENDER" => $row['stud_gender'],
                "STUD_MOB" => $row['stud_mob'],
                "STUD_RESUME" => $row['stud_resume'],
                "STUD_ADDRESS" => $row['stud_address'],
                "CITY_ID" => $row['city_id'],
                "PRIMARY_SKILL" => $row['primary_skill'],
                "SECONDARY_SKILL" => $row['secondary_skill'],
                "TERTIARY_SKILL" => $row['tertiary_skill'],
                "UNIV_ID" => $row['univ_id'],
                "COLLEGE_ID" => $row['college_id'],
                "DEPT_ID" => $row['dept_id'],
                "ACADEMIC_SESSION" => $row['academic_session'],
                "SESSION_START_MONTH" => $row['session_start_month'],
                "SEM" => $row['sem'],
                "ACADEMIC_LEVEL" => $row['academic_level'],
                "SSC_PASS_YR" => $row['ssc_pass_year'],
                "SSC_SCORE" => $row['ssc_score'].$row['ssc_score_type'],
                "HSC_STREAM" =>$row['hsc_stream'],
                "HSC_PASS_YR" =>$row['hsc_pass_year'],
                "HSC_SCORE" => $row['hsc_score'].$row['hsc_score_type'],
                "UG_STRAM" => $row['ug_stream'],
                "UG_PASS_YR" => $row['ug_pass_year'],
                "UG_SCORE" => $row['ug_score'].$row['ug_score_type'],
                "PG_STREAM" => $row['pg_stream'],
                "PG_PASS_YR" => $row['pg_pass_year'],
                "PG_SCORE" => $row['pg_score'].$row['pg_score_type'],
                "CAN_UPDATE_SEM_RESULT" => $row['can_update_sem_result'],
                "CAN_UPDATE_PROFILE" => $row['can_update_profile'],
                "SECTION" => $row['section'],
                "STUD_DOB" => date("d-m-Y", strtotime($row['stud_dob']))
            ]);


             
            
            // $login = new Login();
            // $login->USER_ROLE = $role;
            // $login->USER_ID = $row['STUD_ID'];
            // $login->USER_PASS = md5(date("d-m-Y", strtotime($row['STUD_DOB'])));
            // $login->USER_EMAIL = $row['USER_EMAIL'];
            // $login->USER_STATUS = 0;

            // Department::create([
            //     "DEPT_NAME"=> $row['name']
            // ]);
        }
    }

}
