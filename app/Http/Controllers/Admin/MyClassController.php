<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyClassController extends Controller
{
    public function index(){


        return Inertia::render('Admin/Classes/Index');
    }


    public function create(){


        return Inertia::render('Admin/Classes/Create');
    }
}
