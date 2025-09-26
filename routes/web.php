<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DocumentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\DashboardController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';


Route::middleware(['auth'])->get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth'])->prefix('student')->name('student.')->group(function(){
    Route::resource('documents', \App\Http\Controllers\Student\DocumentController::class);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class,'dashboard'])->name('dashboard');
});

Route::prefix('student')->middleware(['auth'])->group(function () {
    Route::get('documents', [DocumentController::class, 'index'])->name('student.documents.index');
    Route::get('documents/create', [DocumentController::class, 'create'])->name('student.documents.create');
    Route::post('documents', [DocumentController::class, 'store'])->name('student.documents.store');
});

Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('student.documents.edit');
Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('student.documents.update');


Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
});

Route::prefix('admin')->name('admin.')->middleware([IsAdmin::class])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
});

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/students/{id}', [StudentController::class, 'show'])->name('admin.students.show');
});
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
