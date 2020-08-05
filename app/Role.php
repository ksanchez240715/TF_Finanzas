<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
