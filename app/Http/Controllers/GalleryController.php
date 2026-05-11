<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of galleries for the admin.
     */
    public function index() {
        $galleries = Gallery::withCount('images')->latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new gallery.
     */
    public function create() {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created gallery in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120'
        ]);

        try {
            // Handle Cover Thumbnail
            $thumbPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbPath = $request->file('thumbnail')->store('galleries/thumbs', 'public');
            }

            // Create Gallery Entry
            $gallery = Gallery::create([
                'title' => $request->title,
                'description' => $request->description,
                'thumbnail_path' => $thumbPath
            ]);

            // Handle Multiple Gallery Images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('galleries/images', 'public');
                    GalleryImage::create([
                        'gallery_id' => $gallery->id,
                        'image_path' => $path
                    ]);
                }
            }

            return redirect()->route('gallery.index')->with('success', 'Gallery Published Successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['title' => 'Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified gallery.
     */
    public function edit($id) {
        $gallery = Gallery::with('images')->findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery in storage.
     */
    public function update(Request $request, $id) {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:gallery_images,id'
        ]);

        // 1. Update basic info
        $gallery->title = $request->title;
        $gallery->description = $request->description;

        // 2. Update Thumbnail (if new one is uploaded)
        if ($request->hasFile('thumbnail')) {
            // Remove old thumbnail file
            if ($gallery->thumbnail_path) {
                Storage::disk('public')->delete($gallery->thumbnail_path);
            }
            $gallery->thumbnail_path = $request->file('thumbnail')->store('galleries/thumbs', 'public');
        }

        $gallery->save();

        // 3. Delete Selected Gallery Images
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = GalleryImage::find($imageId);
                if ($image) {
                    // Delete physical file
                    Storage::disk('public')->delete($image->image_path);
                    // Delete DB record
                    $image->delete();
                }
            }
        }

        // 4. Upload and Append New Photos
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('galleries/images', 'public');
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('gallery.index')->with('success', 'Gallery Updated Successfully!');
    }

    /**
     * Remove the entire gallery and all associated files.
     */
    public function destroy($id) {
        $gallery = Gallery::with('images')->findOrFail($id);
        
        // Delete Thumbnail file
        if ($gallery->thumbnail_path) {
            Storage::disk('public')->delete($gallery->thumbnail_path);
        }

        // Delete all Gallery image files
        foreach ($gallery->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }
        
        // Delete the database records (assuming cascade delete or manual)
        $gallery->delete();

        return back()->with('success', 'Gallery and all associated photos deleted!');
    }

    /**
     * Public Views
     */
    public function publicIndex() {
        $galleries = Gallery::latest()->get();
        return view('gallery.index', compact('galleries'));
    }

    public function publicShow($id) {
        $gallery = Gallery::with('images')->findOrFail($id);
        return view('gallery.show', compact('gallery'));
    }

    public function show($id) {
        $gallery = Gallery::with('images')->findOrFail($id);
        return view('public.gallery.show', compact('gallery'));
    }
}