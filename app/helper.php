<?php

use Illuminate\Support\Facades\DB;

if(!function_exists('getMonths')){
    function getMonths()
    {
        $month = array(
            "1"=>"Jan",
            "2"=>"Feb",
            "3"=>"Mar",
            "4"=>"Apr",
            "5"=>"May",
            "6"=>"Jun",
            "7"=>"Jul",
            "8"=>"Aug",
            "9"=>"Sep",
            "10"=>"Oct",
            "11"=>"Nov",
            "12"=>"Dec",
        );

        return $month;
    }
}

if(!function_exists('getSemesters')){
    function getSemesters()
    {
        $sem = array(
            "1"=>"I",
            "2"=>"II",
            "3"=>"III",
            "4"=>"IV",
            "5"=>"V",
            "6"=>"VI",
            "7"=>"VII",
            "8"=>"VIII",
        );

        return $sem;
    }
}

if(!function_exists('getUser')){
    function getUser()
    {
        $admin = DB::table('LOGIN_MASTER')
            ->leftJoin('FACULTY_OR_TPO_MASTER','LOGIN_MASTER.USER_ID','=','FACULTY_OR_TPO_MASTER.FACULTY_ID')
            ->select('LOGIN_MASTER.*','FACULTY_OR_TPO_MASTER.*')
            ->where('LOGIN_MASTER.ID','=',session()->get('aid'))
            ->get()[0];

        return $admin;
    }
}