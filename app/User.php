<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Zizaco\Entrust\EntrustRole;

class User extends Authenticatable
{
    use EntrustUserTrait { restore as private restoreA; }
    use SoftDeletes { restore as private restoreB; }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'paternalSurname',
        'maternalSurname',
        'dni',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function restore()
    {
        $this->restoreA();
        $this->restoreB();
    }
}
