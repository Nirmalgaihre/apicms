<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationCategory extends Model
{
    protected $table = 'publication_categories';

    // Set to false because your database table is missing created_at/updated_at columns
    public $timestamps = false;

    protected $fillable = ['title'];
}