<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\refund;
use Illuminate\Support\Facades\Auth;
use Session;

class MailController extends Controller
{
    public function sendMail(){

        $msg=Session::get('msg');
        $mail=Session::get('mail');
        Mail::to($mail)->send(new refund($msg));
        
        Session::flash('success', "Refund Processed");
        return back();

 
    }

    
}
