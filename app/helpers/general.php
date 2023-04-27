<?php

use Illuminate\Support\Facades\Mail;

if (!function_exists('sendEmail')){
    function sendEmail($view,$order,$subject){
        $data = $order->toArray();
        $email = $data['email'];
        $res = Mail::send($view,$data, function ($message) use ($email,$subject) {
            $message->from(env('MAIL_FROM_ADDRESS'),env('APP_NAME'));
            $message->to($email);
            $message->subject($subject);
        });
        return $res;
    }
}

if (!function_exists('Testtest')){
    function Testtest($view,$data,$email,$subject){

    }
}
