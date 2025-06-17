<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class TeacherController extends Controller
{
    public function index(){

        /* $teachers = Teacher::with(['department'])->orderBy('id', 'desc')->paginate(10); */
        $teachers = Teacher::orderBy('id', 'desc')->paginate(10);
        
        return Inertia::render('Admin/Teacher/Index', [
            'teachers' => $teachers,
        ]);
    }

    public function create(){

        return Inertia::render('Admin/Teacher/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:teachers',
            'phone' => 'nullable|string|max:255|unique:teachers',
            'address' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'department' => 'required|string|max:255',
            'dob' => 'required|date',
            'education' => 'required|string|max:255',
            'image_path' => 'nullable',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('teachers', 'public');
        }

        Teacher::create($validated);

        return Redirect::route('admin.teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function update(Request $request, $id){
        $teacher = Teacher::findOrFail($id);

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:teachers,email,'.$teacher->id,
            'phone' => 'nullable|string|max:255|unique:teachers,phone,'.$teacher->id,
            'address' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'department' => 'required|string|max:255',
            'dob' => 'required|date',
            'education' => 'required|string|max:255',
            'image_path' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('teachers', 'public');
        }

        $teacher->update($validated);

        return Redirect::route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return Redirect::route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
