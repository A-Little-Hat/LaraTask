<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\LaraTaskMail;

class MailController extends Controller
{
    public function index(){
        $mailData=[
            'title'=>"Task Assigned",
            'body'=>'body'
        ];
        Mail::to('soumyasarkar309@gmail.com')->send(new LaraTaskMail($mailData));
        dd('mail sent');
    }
}
