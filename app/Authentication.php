<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use HasFactory;
    protected $table = 'authentication_log';
    protected $fillable = [
        'user_id', 'ip_address', 'login_at'
    ];
}
