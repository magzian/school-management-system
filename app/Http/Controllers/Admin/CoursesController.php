<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Redirect;

class CoursesController extends Controller
{
    public function index(){


        return Inertia::render('Admin/Courses/Index');
    }

    public function create(){


        return Inertia::render('Admin/Courses/Create');
    }


    public function store(Request $request){
        // Validate the request data
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:10',
            'description' => 'nullable|string|max:1000',
        ]);

        Course::create($validated);

        return Redirect::route('admin.courses.index')->with('success', 'Course created successfully.');
    }
}
