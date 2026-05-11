<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TevtProgram extends Model
{
    // If your table name is exactly 'tevt_programs', Laravel finds it.
    // We define fillable to allow mass assignment
    protected $fillable = ['type', 'title', 'duration', 'description'];
}