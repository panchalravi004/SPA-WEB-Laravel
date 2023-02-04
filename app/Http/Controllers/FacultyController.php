<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index(){
        return view('section/faculty/view_faculty');
    }

    public function addPage(){
        return view('section/faculty/add_faculty');
    }
}
