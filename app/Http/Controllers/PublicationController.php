<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\PublicationCategory;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    /**
     * ADMIN: List all publications
     */
    public function index()
    {
        $publications = Publication::latest()->get();
        return view('admin.publications.index', compact('publications'));
    }

    /**
     * ADMIN: Show the create form
     */
    public function create()
    {
        $categories = PublicationCategory::all();
        return view('admin.publications.create', compact('categories'));
    }

    /**
     * ADMIN: Store a new publication
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string',
            'description' => 'required',
            'file'        => 'nullable|mimes:pdf,jpg,png,docx|max:10240', // 10MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('publications', 'public');
        }

        Publication::create([
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'nepali_date' => $request->nepali_date,
            'publisher'   => $request->publisher,
            'file_path'   => $filePath,
        ]);

        return redirect()->route('publications.index')->with('success', 'Publication Saved!');
    }

    /**
     * ADMIN: Show the edit form
     * Fix: Combined the two versions and included $categories
     */
    public function edit(Publication $publication)
    {
        // We fetch categories so the dropdown in the edit view works
        $categories = PublicationCategory::all();
        
        return view('admin.publications.edit', compact('publication', 'categories'));
    }

    /**
     * ADMIN: Update the publication
     */
    public function update(Request $request, Publication $publication)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'publisher' => 'required',
            'category'  => 'required',
            'file'      => 'nullable|mimes:pdf,docx,jpg,png|max:10240',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Delete old file if it exists to save server space
            if ($publication->file_path && Storage::disk('public')->exists($publication->file_path)) {
                Storage::disk('public')->delete($publication->file_path);
            }
            // Store new file
            $data['file_path'] = $request->file('file')->store('publications', 'public');
        }

        $publication->update($data);

        return redirect()->route('publications.index')->with('success', 'Publication updated successfully!');
    }

    /**
     * ADMIN: Delete publication and its file
     */
    public function destroy($id)
    {
        $pub = Publication::findOrFail($id);
        
        if ($pub->file_path) { 
            Storage::disk('public')->delete($pub->file_path); 
        }
        
        $pub->delete();
        
        return redirect()->back()->with('success', 'Deleted successfully!');
    }

    /**
     * PUBLIC: View for website visitors
     */
    public function publicIndex()
    {
        $publications = Publication::latest()->paginate(12);
        $categories = PublicationCategory::all(); 

        return view('publications.index', compact('publications', 'categories'));
    }
}