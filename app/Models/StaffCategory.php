<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffCategory extends Model
{
    protected $table = 'staff_categories';

    // Add this line to disable automatic timestamps
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];
}