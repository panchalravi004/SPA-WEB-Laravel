<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index(){
        return view('section/university/manage_university');
    }
}
