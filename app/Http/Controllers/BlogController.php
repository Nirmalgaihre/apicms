<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;  // Your Model Name
use App\Models\BlogImage; // Your Model Name
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller 
{
    // 1. Show all posts (Management Page)
    public function index() {
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        return view('admin.blog.index', compact('posts'));
    }

    // 2. Show create form
    public function create() {
        return view('admin.blog.create');
    }

    // 3. Save new post
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
            'photos.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048'
        ]);

        $post = new BlogPost();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->video_url = $request->video_url;

        if ($request->hasFile('thumbnail')) {
            $post->thumbnail = $request->file('thumbnail')->store('blogs/thumbnails', 'public');
        }
        $post->save();

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('blogs/gallery', 'public');
                BlogImage::create([
                    'post_id' => $post->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('blog.index')->with('success', 'Blog published successfully!');
    }

    // 4. Show Edit Form
    // Using $id here is safer if your route parameters aren't perfectly matched
    public function edit($id)
    {
        $post = BlogPost::with('images')->findOrFail($id);
        return view('admin.blog.edit', compact('post'));
    }

    // 5. Update the post
    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'photos.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048'
        ]);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->video_url = $request->video_url;

        // Update Thumbnail if a new file is uploaded
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $post->thumbnail = $request->file('thumbnail')->store('blogs/thumbnails', 'public');
        }

        $post->save();

        // Add more gallery photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('blogs/gallery', 'public');
                BlogImage::create([
                    'post_id' => $post->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('blog.index')->with('success', 'Blog post updated successfully!');
    }

    // 6. Delete a post
    public function destroy($id) {
        $post = BlogPost::findOrFail($id);
        
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        
        foreach ($post->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $post->delete();
        
        return back()->with('success', 'Blog post deleted successfully!');
    }

    // PUBLIC ROUTES
    public function publicIndex() {
        $posts = BlogPost::orderBy('created_at', 'desc')->paginate(12);
        return view('blog.index', compact('posts'));
    }

    public function publicShow($slug) {
        $post = BlogPost::where('slug', $slug)->with('images')->firstOrFail();
        return view('blog.show', compact('post'));
    }
}