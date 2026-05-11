<?php
namespace App\Http\Controllers;

use App\Models\Course; // Import the Model
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Fetch all courses
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    // Fetch a single course by ID
    public function show($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        return response()->json($course);
    }
}