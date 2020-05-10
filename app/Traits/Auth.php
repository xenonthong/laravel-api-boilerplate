<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth as FacadesAuth;

trait Auth {
    public function logout()
    {
        if (FacadesAuth::check()) {
            FacadesAuth::user()->token()->revoke();
        }
    }
}
