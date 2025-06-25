<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index(){

        $departments = Department::all();

        return Inertia::render('Admin/Departments/Index', [
            'departments' => $departments
        ]);
    }


    public function create(){
        return Inertia::render('Admin/Departments/Create');
    }
}
