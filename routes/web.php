<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StudentController;

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
    Route::patch('/students/{student}', [StudentController::class,'update'])->name('admin.students.update');
    Route::delete('/students/{student}', [StudentController::class,'destroy'])->name('admin.students.destroy');
});



require __DIR__.'/auth.php';
