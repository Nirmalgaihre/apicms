<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\NoticeCategory;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    // ===========================
    // PUBLIC METHODS (For Frontend)
    // ===========================

    /**
     * Display all notices for the public with optional category filtering
     */
    public function allNotices(Request $request)
    {
        $categories = NoticeCategory::all();
        $query = Notice::query();
        
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }
        
        $notices = $query->latest()->paginate(12);

        return view('notices.index', compact('notices', 'categories'));
    }

    /**
     * Displays a single notice detail page
     */
    public function show($id)
    {
        $notice = Notice::findOrFail($id);
        return view('notices.show', compact('notice'));
    }

    // ===========================
    // ADMIN METHODS (For Management)
    // ===========================

    /**
     * Manage Notices List (Admin Dashboard)
     */
    public function index()
    {
        $notices = Notice::latest()->paginate(10);
        return view('admin.notices.index', compact('notices'));
    }

    /**
     * Show create notice form
     */
    public function create()
    {
        $categories = NoticeCategory::all();
        return view('admin.notices.create', compact('categories'));
    }

    /**
     * Store a new notice
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'required',
            'nepali_date' => 'nullable|string',
            'publisher'   => 'nullable|string|max:255',
            'file'        => 'nullable|mimes:pdf,jpg,png,jfif|max:5120',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('notices', 'public');
        }

        Notice::create([
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'nepali_date' => $request->nepali_date,
            'publisher'   => $request->publisher,
            'file_path'   => $filePath,
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice Published Successfully!');
    }

    /**
     * Delete a notice
     */
    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        
        // Delete the file from storage if it exists
        if ($notice->file_path && Storage::disk('public')->exists($notice->file_path)) {
            Storage::disk('public')->delete($notice->file_path);
        }

        $notice->delete();

        return redirect()->back()->with('success', 'Notice deleted successfully!');
    }
    public function edit($id)
{
    $notice = Notice::findOrFail($id);
    $categories = NoticeCategory::all();
    return view('admin.notices.edit', compact('notice', 'categories'));
}

/**
 * Update the existing notice
 */
public function update(Request $request, $id)
{
    $notice = Notice::findOrFail($id);

    $request->validate([
        'title'       => 'required|string|max:255',
        'category'    => 'required|string|max:255',
        'description' => 'required',
        'nepali_date' => 'nullable|string',
        'publisher'   => 'nullable|string|max:255',
        'file'        => 'nullable|mimes:pdf,jpg,png,jfif|max:5120',
    ]);

    if ($request->hasFile('file')) {
        // Delete old file if it exists
        if ($notice->file_path && Storage::disk('public')->exists($notice->file_path)) {
            Storage::disk('public')->delete($notice->file_path);
        }
        $notice->file_path = $request->file('file')->store('notices', 'public');
    }

    $notice->update([
        'title'       => $request->title,
        'category'    => $request->category,
        'description' => $request->description,
        'nepali_date' => $request->nepali_date,
        'publisher'   => $request->publisher,
        'file_path'   => $notice->file_path,
    ]);

    return redirect()->route('notices.index')->with('success', 'Notice Updated Successfully!');
}
}