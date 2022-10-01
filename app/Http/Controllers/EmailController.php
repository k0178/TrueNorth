<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    function index(){
        $title = "Confirm Email";
        return view('pages.confirmEmail',compact('title'));
    }
}
