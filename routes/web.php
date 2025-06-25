<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DormController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\MyClassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\DepartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return Inertia::render('Admin/Dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/students', [StudentController::class,'index'])->name('admin.students.index');
    Route::get('/students/create', [StudentController::class,'create'])->name('admin.students.create');
    Route::post('/students/store', [StudentController::class,'store'])->name('admin.students.store');
    Route::get('/students/{student}', [StudentController::class,'show'])->name('admin.students.show');
    Route::get('/students/{student}/edit', [StudentController::class,'edit'])->name('admin.students.edit');
    Route::put('/students/update/{id}',[StudentController::class,'update'])->name('admin.students.update');
    Route::delete('/students/delete/{id}', [StudentController::class,'destroy'])->name('admin.students.destroy');


    //teacher routes
    Route::get('/teachers', [TeacherController::class, 'index'])->name('admin.teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
    Route::post('/teachers/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
    Route::put('/teachers/update/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
    Route::delete('/teachers/delete/{id}', [TeacherController::class, 'destroy'])->name('admin.teachers.destroy');


    //Department routes
    Route::get('/departments', [DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create');


    //Dorm routes
    Route::get('/dorms', [DormController::class, 'index'])->name('admin.dorms.index');


    //Classes routes
    Route::get('/classes', [MyClassController::class, 'index'])->name('admin.classes.index');
    Route::get('/classes/create', [MyClassController::class, 'create'])->name('admin.classes.create');


    //Subject/Course routes  
    //On the frontend side it will be called subjects while in the backend it will be called courses
    Route::get('/subjects', [CoursesController::class, 'index'])->name('admin.courses.index');
    Route::get('/subjects/create', [CoursesController::class, 'create'])->name('admin.courses.create');

});




require __DIR__.'/auth.php';
