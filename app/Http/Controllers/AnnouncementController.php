<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    /**
     * PUBLIC: List all programs grouped by category.
     * Location: views/programs/index.blade.php
     */
    public function publicShortTerm()
    {
        $categoriesWithAnnouncements = AnnouncementCategory::with(['announcements' => function($query) {
            $query->where('is_active', 1)->latest();
        }])->get();

        return view('programs.index', compact('categoriesWithAnnouncements'));
    }

    /**
     * PUBLIC: Individual program detail page.
     * Yo method tapaiko route ko 'showPublic' sanga match hunchha.
     */
    public function showPublic($id)
    {
        // Tapaiko Blade le '$program' variable khojirako chha
        $program = Announcement::with('category')->findOrFail($id);
        
        // Location: views/programs/show.blade.php
        return view('programs.show', compact('program'));
    }

    /**
     * ADMIN: Dashboard listing.
     */
    public function index()
    {
        $announcements = Announcement::with('category')->latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * ADMIN: Show create form.
     */
    public function create()
    {
        $categories = AnnouncementCategory::all();
        return view('admin.announcements.create', compact('categories'));
    }

    /**
     * ADMIN: Store new announcement.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:announcement_categories,id',
            'description' => 'nullable|string',
            'file_path'   => 'nullable|file|mimes:pdf,jpg,png|max:5120',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = 1; 

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('announcements', 'public');
        }

        Announcement::create($data);

        return redirect()->route('announcements.index')->with('success', 'Added successfully!');
    }

    /**
     * ADMIN: Edit form.
     */
    public function edit(Announcement $announcement)
    {
        $categories = AnnouncementCategory::all();
        return view('admin.announcements.edit', compact('announcement', 'categories'));
    }

    /**
     * ADMIN: Update logic.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:announcement_categories,id',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('file_path')) {
            if ($announcement->file_path) {
                Storage::disk('public')->delete($announcement->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('announcements', 'public');
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Updated successfully!');
    }

    /**
     * ADMIN: Delete logic.
     */
    public function destroy(Announcement $announcement)
    {
        if ($announcement->file_path) {
            Storage::disk('public')->delete($announcement->file_path);
        }
        $announcement->delete();
        return back()->with('success', 'Deleted successfully!');
    }
    public function categories()
{
    $categories = AnnouncementCategory::all();
    // Make sure this view file actually exists!
    return view('admin.announcements.categories', compact('categories'));
}
}