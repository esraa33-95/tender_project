<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Otp;


class GenerateOtp
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
      $code = Otp::generatecode(); 

      Otp::create([
        'user_id'=>$event->user->id,
        'code'=>$code,
        'expired_at'=>now()->addMinutes(3),
      ]);
    }
}
