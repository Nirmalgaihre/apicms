<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    protected $fillable = [
        'email', 
        'ip_address', 
        'user_agent', 
        'is_successful', 
        'guard'
    ];

    // Since you used $table->timestamps() in the migration, 
    // leave timestamps as true (default) or set it explicitly:
    public $timestamps = true; 
}