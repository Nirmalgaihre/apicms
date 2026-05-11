<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffCategoryController extends Controller
{
    // Show the list of categories and the "Add New" form
   public function index()
{
    $categories = DB::table('staff_categories')
        ->orderByRaw('CAST(position AS UNSIGNED) ASC')
        ->get();

    // Pointing to admin/staff/categories.blade.php
    return view('admin.staff.categories', compact('categories'));
}

    // Save a new category
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $maxPos = DB::table('staff_categories')->max(DB::raw('CAST(position AS UNSIGNED)'));
        
        DB::table('staff_categories')->insert([
            'title' => $request->title,
            'position' => $maxPos ? $maxPos + 1 : 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Category added successfully!');
    }

    // Delete a category
    public function destroy($id)
    {
        DB::table('staff_categories')->where('id', $id)->delete();
        return back()->with('success', 'Category removed.');
    }
    public function publicIndex() {
    $staff = DB::table('staff')
        ->leftJoin('staff_categories', 'staff.staff_category', '=', 'staff_categories.id')
        ->select(
            'staff.*', 
            'staff_categories.title as category_title',
            'staff_categories.position as cat_pos'
        )
        // Step 1: Sort the raw data numerically
        ->orderByRaw('CAST(cat_pos AS UNSIGNED) ASC') 
        ->orderByRaw('CAST(staff.position AS UNSIGNED) ASC') 
        ->get();

    // Step 2: Group and RE-SORT the groups by the category position
    // This prevents "10" from jumping ahead of "2" in the list of categories
    $staffGroups = $staff->groupBy('category_title')->sortBy(function ($group) {
        return (int) $group->first()->cat_pos;
    });

    return view('staff.index', compact('staffGroups'));
}
}