<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\BlogPost; // Added
use App\Models\Notice;   // Added
use App\Models\Staff;   // Added
use App\Models\Description; 
use App\Models\Publication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Shows all albums at /gallery
    public function publicIndex()
    {
        $galleries = Gallery::with('images')->has('images')->latest()->get();
        return view('gallery.index', compact('galleries'));
    }

    // Shows specific album at /gallery/{id}
    public function publicShow($id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);
        return view('gallery.show', compact('gallery'));
    }

    // Admin view to manage galleries
    public function index()
    {
        $galleries = Gallery::with('images')->latest()->get();
        return view('admin.gallery', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $gallery = Gallery::create($request->only('title', 'description'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('galleries', 'public');
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $path
                ]);
            }
        }
        return back()->with('success', 'Gallery created successfully!');
    }
}

class HomeController extends Controller {
public function index() {
    $notices = \DB::table('notices')->latest()->take(10)->get();
    $blogs = \DB::table('blog_posts')->latest()->take(3)->get();
    
    $principal = \DB::table('staff')
        ->leftJoin('staff_categories', 'staff.staff_category', '=', 'staff_categories.id')
        ->where('staff_categories.title', 'Principal')
        ->select('staff.*')
        ->first();

    $staffs = \DB::table('staff')
        ->leftJoin('staff_categories', 'staff.staff_category', '=', 'staff_categories.id')
        ->where('staff_categories.title', '!=', 'Principal')
        ->orderBy('staff.position', 'asc')
        ->take(4)
        ->get();

    $principalMessage = \DB::table('descriptions')->first();
    $publications = Publication::latest()->limit(4)->get();
    // Fetch galleries
$galleries = \DB::table('galleries')->latest()->take(4)->get();

// Manually attach the first image path for each gallery
foreach($galleries as $gallery) {
    $gallery->first_image = \DB::table('gallery_images')
        ->where('gallery_id', $gallery->id)
        ->value('image_path'); // This gets just the string path
}

return view('welcome', compact('notices', 'blogs', 'principal', 'staffs', 'principalMessage', 'galleries', 'publications'));

    // MAKE SURE TO ADD 'galleries' TO COMPACT
    return view('welcome', compact(
        'notices', 
        'blogs', 
        'principal', 
        'staffs', 
        'principalMessage', 
        'galleries'
    ));
}
}