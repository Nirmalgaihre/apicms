<?php

namespace App\Http\Controllers;

use App\Models\AcademicOffering; // This imports the model from the correct file
use Illuminate\Http\Request;

class AcademicProgramController extends Controller
{
    public function index()
    {
        $categories = AcademicOffering::where('type', 'category')->with('children')->get();
        return view('admin.programs.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:category,long_term,short_term',
            'parent_id' => 'nullable|exists:academic_offerings,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('programs', 'public');
        }

        AcademicOffering::create($data);
        return back()->with('success', 'Added successfully!');
    }

    public function destroy($id)
    {
        AcademicOffering::findOrFail($id)->delete();
        return back()->with('success', 'Deleted successfully!');
    }
}