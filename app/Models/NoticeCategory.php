<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeCategory extends Model
{
    // Points to your specific table
    protected $table = 'notice_categories';

    // Disable timestamps if your table doesn't have created_at/updated_at
    public $timestamps = false;

    protected $fillable = ['name'];
}