<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class VideoController extends Controller
{
    public function index() {
        $videos = Video::latest()->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create() {
        return view('admin.videos.create');
    }

    public function store(Request $request) {
        // Updated validation to allow either a file or a YouTube URL
        $request->validate([
            'title' => 'required|string|max:255',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:102400', // 100MB Max
            'video_url' => 'nullable|url', // YouTube link validation
        ]);

        try {
            $path = null;

            // Handle Local File Upload
            if ($request->hasFile('video_file')) {
                $file = $request->file('video_file');
                $path = $file->store('videos', 'public');
            }
            
            // Insert into Database (Supports both file_path and video_url)
            $inserted = Video::create([
                'title'       => $request->title,
                'file_path'   => $path,
                'video_url'   => $request->video_url,
                'description' => $request->description,
            ]);

            if($inserted) {
                return redirect()->route('videos.index')->with('success', 'Video saved successfully!');
            }
            
            return back()->with('error', 'Operation failed.');

        } catch (Exception $e) {
            return back()->with('error', 'Database Error: ' . $e->getMessage());
        }
    }

    public function destroy(Video $video) {
        // Only delete from storage if a local file exists
        if ($video->file_path) {
            Storage::disk('public')->delete($video->file_path);
        }
        $video->delete();
        return back()->with('success', 'Video deleted!');
    }

    // Show the Edit Form
    public function edit(Video $video) {
        return view('admin.videos.edit', compact('video'));
    }

    // Update the Video
    public function update(Request $request, Video $video) {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:102400', 
            'video_url' => 'nullable|url',
        ]);

        $data = [
            'title' => $request->title,
            'video_url' => $request->video_url,
            'description' => $request->description,
        ];

        // Check if a NEW video file is being uploaded
        if ($request->hasFile('video_file')) {
            // Delete the OLD file from storage if it exists
            if ($video->file_path) {
                Storage::disk('public')->delete($video->file_path);
            }
            // Store the NEW file
            $data['file_path'] = $request->file('video_file')->store('videos', 'public');
        }

        $video->update($data);

        return redirect()->route('videos.index')->with('success', 'Video updated successfully!');
    }

    // Public Index for gallery view
    public function publicIndex() {
        $videos = Video::latest()->get();
        return view('videos.index', compact('videos'));
    }
}