<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // If your table name is 'courses', Laravel finds it automatically.
    // However, since you don't have an 'updated_at' column in your SQL:
    public $timestamps = false; 

    protected $fillable = [
        'title', 
        'duration', 
        'description', 
        'eligibility'
    ];
}
