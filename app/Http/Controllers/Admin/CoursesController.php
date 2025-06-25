<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    public function index(){


        return Inertia::render('Admin/Courses/Index');
    }

    public function create(){


        return Inertia::render('Admin/Courses/Create');
    }
}
