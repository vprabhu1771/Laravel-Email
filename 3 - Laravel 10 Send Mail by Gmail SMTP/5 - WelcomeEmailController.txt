<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Mail\WelcomeEmail;

class WelcomeEmailController extends Controller
{
    public function index() 
    {
        $subject = "Test Welcome Subject";
        $body = "Test Welcome Message";

        Mail::to('recipient@gmail.com')->send(new WelcomeEmail($subject, $body));
    }
}
