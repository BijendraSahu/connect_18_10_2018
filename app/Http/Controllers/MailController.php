<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Mail;

class MailController extends Controller
{
    public function send()
    {
        Mail::send(['text' => 'mail'], ['name', 'Aditya'], function ($message) {
            $message->to('retinodes.bijendra@gmail.com', 'TO Aditya')->subject('test Email hai');
            $message->from('retinodes.bijendra@gmail.com', 'aditya');
        });
    }

    public function test()
    {
       echo Carbon::now('Asia/Kolkata');
    }
}
