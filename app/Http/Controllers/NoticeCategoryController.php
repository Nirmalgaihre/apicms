<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoticeCategory;

class NoticeCategoryController extends Controller
{
    public function index()
    {
        $categories = NoticeCategory::all();
        return view('admin.notices.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:notice_categories,name|max:100']);
        
        NoticeCategory::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function destroy($id)
    {
        NoticeCategory::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category deleted!');
    }
}