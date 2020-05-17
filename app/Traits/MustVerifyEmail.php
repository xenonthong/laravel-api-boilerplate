<?php

namespace App\Traits;

use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Auth\MustVerifyEmail as IlluminateMustVerifyEmail;
use Illuminate\Support\Facades\Config;

trait MustVerifyEmail {

    use IlluminateMustVerifyEmail;

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
}
