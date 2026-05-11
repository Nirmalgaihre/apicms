<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model {
    protected $table = 'blog_posts';
    protected $fillable = ['category_id', 'title', 'slug', 'description', 'thumbnail', 'video_url'];

    // Relationship for multiple photos
    public function images() {
        return $this->hasMany(BlogImage::class, 'post_id');
    }
}