<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class HomeController extends Controller
{
    //
    public function sendEmailManually()
    {
        $recipient = 'recipient@example.com'; // Replace with actual recipient's email
        $subject = 'Custom Subject';
        $body = 'This is the body of the email. You can include HTML here if needed.';

        Mail::raw($body, function(Message $message) use ($recipient, $subject) {
            $message->to($recipient);
            $message->subject($subject);
            // You can add attachments or other options here if needed
        });

        return "Email sent successfully!";
    }
}
