<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\MustVerifyEmail as TraitsMustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use TraitsMustVerifyEmail;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'mobile', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'roles.created_at',
        'updated_at',
        'roles.updated_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['roles:name'];

    /**
     * Mutate password
     *
     * @param String $password
     * @return void
     */
    public function setPasswordAttribute($password) : void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Mutate username
     *
     * @param String $username
     * @return void
     */
    public function setUsernameAttribute($username) : void
    {
        $this->attributes['username'] = strtolower($username);
    }
}
