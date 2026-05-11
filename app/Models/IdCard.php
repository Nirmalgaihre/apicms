<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdCard extends Model
{
    use HasFactory;
    protected $table = 'id_cards';
    protected $fillable = ['name', 'program', 'address', 'batch', 'mobile_number', 'expire_date', 'profile_image'];
}