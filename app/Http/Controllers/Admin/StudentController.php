<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dorm;
use Inertia\Inertia;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    public function index(){

        $students = Student::with(['my_class', 'dorm', 'department'])->get();
        return Inertia::render('Admin/Student/Index', [
            'students' => $students,
        ]);
    }

    public function create(){
        $classes = Classes::all();
        $dorms = Dorm::all();
        $departments = Department::all();


        return Inertia::render('Admin/Student/Create', [
            'classes' => $classes,
            'dorms' => $dorms,
            'departments' => $departments,
        ]);
    }

    public function show(Student $student){

        $student->load(['my_class', 'dorm', 'department']);
        
        return Inertia::render('Admin/Student/Show', [
            'student' => $student,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:students',
            'phone' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'reg_date' => 'required|date',
            'parent_number' => 'required|string|max:255',
            'parent_email' => 'required|string|email|max:255',
            'dob' => 'required|date',
            'blood_group' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('image_path')){
            $imagePath = $request->file('image_path')->store('students', 'public');
            $validated['image_path'] = $imagePath;
        }
        
        Student::create($validated);

        return Redirect::route('admin.students.index')->with('success', 'Student created successfully');
    }

    public function update(Request $request, Student $student){
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:students'.$student->id,
            'phone' => 'nullable|string|max:255|unique:students'.$student->id,
            'address' => 'required|string|max:255',
            'reg_date' => 'required|date',
            'parent_number' => 'required|string|max:255',
            'parent_email' => 'required|string|email|max:255',
            'dob' => 'required|date',
            'blood_group' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('image_path')){
            $imagePath = $request->file('image_path')->store('students', 'public');
            $validated['image_path'] = $imagePath;
        }
        
        $student->update($validated);

        return Redirect::route('admin.students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        
        return Redirect::route('students.index')->with('success', 'Student deleted successfully.');
    }
}
