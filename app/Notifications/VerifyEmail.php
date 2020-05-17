<?php

namespace App\Notifications;

use App\Traits\Auth;
use Illuminate\Auth\Notifications\VerifyEmail as NotificationsVerifyEmail;
use Illuminate\Support\Facades\Config;

class VerifyEmail extends NotificationsVerifyEmail
{
    use Auth;

    /**
     * Override the get verification URL function
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return Config::get('app.frontend') . "/auth/verify/?id={$notifiable->getKey()}&hash={$this->getHash($notifiable)}";
    }
}
