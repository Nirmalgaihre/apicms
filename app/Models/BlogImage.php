<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model {
    protected $table = 'blog_images';
    public $timestamps = false;
    protected $fillable = ['post_id', 'image_path'];
}