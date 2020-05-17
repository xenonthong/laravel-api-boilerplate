<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordChangeRequest;
use App\Traits\Auth as TraitsAuth;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    use TraitsAuth;

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordChangeRequest $request)
    {
        $update = Auth::user()
                ->update([
                    'password' => $request->new
                ]);

        $this->logout();

        return $update;
    }
}
