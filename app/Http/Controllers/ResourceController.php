<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    // List Page
    public function index() {
        $resources = DB::table('resources')->orderBy('id', 'desc')->get();
        return view('admin.resources.index', compact('resources'));
    }

    // Create Page (Show Form)
    public function create() {
        return view('admin.resources.create');
    }

    // Save Logic
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $path = $request->file('file')->store('resources', 'public');

        DB::table('resources')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('resources.index')->with('success', 'Created!');
    }

    // Edit Page (Show Form)
    public function edit($id) {
        $resource = DB::table('resources')->where('id', $id)->first();
        return view('admin.resources.edit', compact('resource'));
    }

    // Update Logic
    public function update(Request $request, $id) {
        $updateData = ['title' => $request->title, 'description' => $request->description, 'updated_at' => now()];

        if ($request->hasFile('file')) {
            $oldFile = DB::table('resources')->where('id', $id)->value('file_path');
            Storage::disk('public')->delete($oldFile);
            $updateData['file_path'] = $request->file('file')->store('resources', 'public');
        }

        DB::table('resources')->where('id', $id)->update($updateData);
        return redirect()->route('resources.index')->with('success', 'Updated!');
    }

    // Delete Logic
    public function destroy($id) {
        $file = DB::table('resources')->where('id', $id)->value('file_path');
        Storage::disk('public')->delete($file);
        DB::table('resources')->where('id', $id)->delete();
        return redirect()->route('resources.index')->with('success', 'Deleted!');
    }
}