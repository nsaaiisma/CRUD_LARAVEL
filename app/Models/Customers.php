<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $guard = 'customer';

    protected $fillable = [
        'name',
        'email',
        'password',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
