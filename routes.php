<?php

use Aloha\Twilio\Twilio;
use Illuminate\Support\Facades\Route;

Route::post('api/sendMessage', function (){
   Twilio::message('+421950210759', 'test bota');
});
