<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        return view('section/student/view_student');
    }

    public function addPage(){
        return view('section/student/add_student');
    }
}
