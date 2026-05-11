<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // If your table name isn't "staffs" (Laravel's default plural), 
    // uncomment the line below and set it to your actual table name:
    // protected $table = 'staff'; 

    protected $fillable = [
        'staff_name',
        'staff_category',
        'staff_phone',
        'staff_email',
        'staff_img'
    ];

    public function category()
    {
        // Assuming your category model is StaffCategory
        return $this->belongsTo(StaffCategory::class, 'staff_category');
    }
}