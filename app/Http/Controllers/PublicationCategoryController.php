<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicationCategory;
use Illuminate\Support\Str;

class PublicationCategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        // Fetch all categories, ordered by newest first
        $categories = PublicationCategory::latest()->get();

        // Points to: resources/views/admin/publications/categories.blade.php
        return view('admin.publications.categories', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255|unique:publication_categories,title',
        ]);

        // 2. Create the record
        PublicationCategory::create([
            'title' => $request->title,
            'slug'  => Str::slug($request->title), // Generates "news-and-updates" from "News and Updates"
        ]);

        // 3. Redirect back with success message
        return back()->with('success', 'Publication Category added successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        // Find the category or fail with a 404 error
        $category = PublicationCategory::findOrFail($id);
        
        $category->delete();

        return back()->with('success', 'Category deleted successfully!');
    }
}