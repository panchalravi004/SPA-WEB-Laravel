<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index(){
        return view('section/jobs/view_jobs');
    }

    public function addPage(){
        return view('section/jobs/add_jobs');
    }
}
