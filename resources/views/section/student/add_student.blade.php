@extends('layouts.home')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Create Student</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Any Button
        </a>
    </div>

    <form class="container p-2" method="post" action=".\dbconnection\insert_student_info.php">
        <h4 class="text-secondary">Personal Information</h4>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-4">
                <label for="Input_College_Id">Student Id </label>
                <input type="text" class="form-control" placeholder="Student Id" name="stud_id" id="id_stud_id" required>

            </div>
            <div class="form-group col-4">
                <label for="Student_name">Name</label>
                <input type="text" class="form-control" placeholder="Student's Name" name="stud_name" id="id_stud_name" required>

            </div>
            <div class="form-group col-4">
                <label for="Student_email">Email</label>
                <input type="text" pattern="[^ @]*@[^ @]*" validate="required:true" class="form-control" placeholder="Email" name="stud_email" id="id_stud_email" required>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-2">
                <label for="Student_dob">Date Of Birth</label>
                <input type="date" min="1985-01-01" class="form-control" placeholder="DOB of Student" name="stud_dob" id="id_stud_dob" required>
            </div>

            <div class="form-group col-2">
                <label for="Student_gender">Gender</label>

                <select class="form-control" name="stud_gender" id="id_stud_gender" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="othera">Other</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="Student_email">Mobile no(Whatsapp no)</label>
                <input type="text" class="form-control" placeholder="Contact Whatsapp No(Optional)" name="stud_w_mob_no" id="id_stud_w_mob_no">

            </div>
            <div class="form-group col-4">
                <label for="Student_mob_no">Mobile No.</label>
                <!-- <input type="text" pattern="[6-9]{1}[0-9]{9}" class="form-control" placeholder="Contact no of Student" name="stud_mob_no" id="id_stud_mob_no" required> -->
                <input type="text" class="form-control" placeholder="Contact no of Student" name="stud_mob_no" id="id_stud_mob_no" required>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-2">
                <label for="Student_street">Country</label>
                <!-- <input type="text" class="form-control" placeholder="Country Name" name="stud_country" id="id_stud_country" required> -->

                <select class="form-control" name="stud_country" id="id_stud_country" required>
                    <option value="none" selected disabled hidden>Select Country</option>
                    
                </select>

            </div>
            <div class="form-group col-2">
                <label for="Student_state">State</label>

                <select class="form-control" name="stud_state" id="id_stud_state" required>
                    <option value="none" selected disabled hidden>Select State</option>
                    
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_city">City</label>

                <select class="form-control" name="stud_city" id="id_stud_city" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_pincode">Pin code</label>
                <input type="text" pattern="([1-9]{1}[0-9]{5}|[1-9]{1}[0-9]{3}\\s[0-9]{3})" class="form-control" placeholder="Pin Code" name="stud_pin_code" id="id_stud_pin_code" required>
            </div>

            <div class="form-group col-4">
                <label for="Student_street">Address</label>
                <input type="text" class="form-control" placeholder="Address" name="stud_address" id="id_stud_address" required>
            </div>

        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <h4 class="text-secondary">Acadmic Details</h4>

        <div class="row justify-content-center align-items-center">
            <div class="form-group col-2">
                <label for="Student_dob">Primary Skill</label>

                <select class="form-control" name="stud_p_skill" id="id_stud_p_skill" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>

            <div class="form-group col-2">
                <label for="Student_gender">Secondary Skill</label>

                <select class="form-control" name="stud_s_skill" id="id_stud_s_skill" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_email">Tertiary Skill</label>

                <select class="form-control" name="stud_t_skill" id="id_stud_t_skill" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>
            <div class="form-group col-4">
                <label for="Student_email">University Name</label>

                <select class="form-control" name="univ_name" id="id_univ_name" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_email">College Name</label>

                <select class="form-control" name="college_name" id="id_college_name" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>

        </div>

        <div class="row justify-content-center align-items-center">
            <div class="form-group col-2">
                <label for="Student_dob">Department</label>

                <select class="form-control" name="stud_coll_dept_id" id="id_stud_coll_dept_id" required>
                    <option value="none" selected disabled hidden>Select</option>
                </select>
            </div>

            <div class="form-group col-2">
                <label for="Student_gender">Academic Session</label>
                <input type="text" class="form-control" placeholder="Enter Student Acadmic Session" name="stud_academic_session" id="id_stud_academic_session" required>
            </div>
            <div class="form-group col-2">
                <label for="Student_email">Session Start Month</label>

                <select class="form-control" name="stud_session_start_m" id="id_stud_session_start_m" required>
                    <option value="none" selected disabled hidden>Select</option>

                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_gender">Academic Level</label>
                <input type="text" class="form-control" placeholder="Acadmic Level" name="stud_acadmic_level" id="id_stud_acadmic_level" required>
            </div>
            <div class="form-group col-2">
                <label for="Student_email">Semester</label>

                <select class="form-control" name="stud_sem" id="id_stud_sem" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1">I</option>
                    <option value="2">II</option>
                    <option value="3">III</option>
                    <option value="4">IV</option>
                    <option value="5">V</option>
                    <option value="6">VI</option>
                    <option value="7">VII</option>
                    <option value="8">VIII</option>
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_gender">Student Section</label>
                <input type="text" class="form-control" placeholder="Student Section" name="stud_section" id="id_stud_section">
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-2">
                <label for="Student_dob">SSC Score In</label>
                <select class="form-control" name="ssc_score_mode" id="id_ssc_score_mode" required>
                    <option value="percentage">Percentage</option>
                    <option value="cgpa">CGPA</option>
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_gender">SSC Score</label>
                <input type="text" class="form-control" placeholder="SSC Marks" name="stud_ssc_score" id="id_stud_ssc_score" required>
            </div>
            <div class="form-group col-2">
                <label for="Student_gender">SSC Pass Year</label>
                <input type="text" class="form-control" placeholder="SSC Pass Year" name="stud_ssc_p_year" id="id_stud_ssc_p_year" required>
            </div>
            <div class="form-group col-2">
                <label for="Student_dob">HSC Score In</label>
                <select class="form-control" name="hsc_score_mode" id="id_hsc_score_mode" required>
                    <option value="percentage">Percentage</option>
                    <option value="cgpa">CGPA</option>
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_email">HSC Score</label>
                <input type="text" class="form-control" placeholder="HSC Marks" name="stud_hsc_score" id="id_stud_hsc_score" required>
            </div>
            <div class="form-group col-2">
                <label for="Student_email">Hsc Pass Year</label>
                <input type="text" class="form-control" placeholder="HSC Pass Year" name="stud_hsc_p_year" id="id_stud_hsc_p_year" required>
            </div>

        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-4">
                <label for="Student_street">HSC Stream</label>
                <select class="form-control" name="stud_hsc_stream" id="id_stud_hsc_stream" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_street">UG Score In</label>

                <select class="form-control" name="ug_score_mode" id="id_ug_score_mode" required>
                    <option value="percentage">Percentage</option>
                    <option value="cgpa">CGPA</option>
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_street">UG Score</label>
                <input type="text" class="form-control" placeholder="PG Marks" name="stud_ug_score" id="id_stud_ug_score" required>
            </div>
            <div class="form-group col-2">
                <label for="Student_street">UG Pass Year</label>
                <input type="text" class="form-control" placeholder="PG Marks" name="stud_ug_p_year" id="id_stud_ug_p_year" required>
            </div>
            <div class="form-group col-2">
                <label for="Student_street">UG Stream</label>
                <!-- <select class="form-control" name="stud_ug_stream" id="id_stud_ug_stream" required>
                    <option value="percentage">Percentage</option>
                    <option value="cgpa">CGPA</option>
                </select> -->
                <select class="form-control" name="stud_ug_stream" id="id_stud_ug_stream" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-2">

                <label for="Student_street">PG Score In</label>
                <select class="form-control" name="pg_score_mode" id="id_pg_score_mode" required>
                    <option value="percentage">Percentage</option>
                    <option value="cgpa">CGPA</option>
                </select>
            </div>
            <div class="form-group col-2">
                <label for="Student_street">PG Score</label>
                <input type="text" class="form-control" placeholder="PG Marks" name="stud_pg_score" id="id_stud_pg_score">
            </div>
            <div class="form-group col-2">
                <label for="Student_street">PG Pass Year</label>
                <input type="text" class="form-control" placeholder="PG Pass Yeart" name="stud_pg_p_year" id="id_stud_pg_p_year">
            </div>
            <div class="form-group col-2">
                <label for="Student_street">PG Stream</label>
                <select class="form-control" name="stud_pg_stream" id="id_stud_pg_stream" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>

            </div>
            <div class="form-group col-2">
                <label for="Student_street">Update Sem Result</label>

                <select class="form-control" name="stud_can_u_result" id="id_stud_can_u_result" required>

                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group col-2">
                <label for="Student_city">Can Update Profile</label>

                <select class="form-control" name="stud_u_profile" id="id_stud_u_profile" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        
        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <div class="row justify-content-center align-items-center g-2">
            <input type="submit" value="Submit" name="insert" class="btn btn-primary m-2">
            <input type="reset" value="Reset" name="reset" class="btn btn-primary m-2">
        </div>
    </form>
@endsection