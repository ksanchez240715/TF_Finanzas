<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUserModel extends Model
{
    protected $table = "role_user";

    protected $fillable = [
        'role_id',
        'user_id'
    ];
    public $timestamps = false;
}
