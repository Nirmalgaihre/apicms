<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {
    // This allows these fields to be saved to the DB
    protected $fillable = ['title', 'description', 'thumbnail_path'];

    public function images() {
        return $this->hasMany(GalleryImage::class);
    }
}