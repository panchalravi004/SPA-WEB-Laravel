<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        return view('section/company/view_company');
    }

    public function addPage(){
        return view('section/company/add_company');
    }
}
