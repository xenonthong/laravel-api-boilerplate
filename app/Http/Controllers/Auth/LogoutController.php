<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\Auth;

class LogoutController extends Controller
{
    /**
     * Trait that removes the Authenticated user's token
     */
    use Auth;
}
