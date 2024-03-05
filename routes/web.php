<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;


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

# admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin-only routes or actions
});

# tasks
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/view/{task_id}', [TaskController::class, 'main'])->name('tasks.main');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/create', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/edit/{task_id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/edit/{task_id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/tasks/edit/status/{task_id}', [TaskController::class, 'editStatus'])->name('tasks.editstatus');
    Route::put('/tasks/edit/status/{task_id}', [TaskController::class, 'updateStatus'])->name('tasks.updatestatus');
    Route::delete('/tasks/delete/{task_id}', [TaskController::class, 'remove'])->name('tasks.remove');
});

# comments
Route::middleware(['auth'])->group(function () {
    Route::post('/comment/add/{task_id}', [CommentController::class, 'add'])->name('comments.add');
});


#demo
Route::get('/demo', [TaskController::class, 'demo']);
require __DIR__.'/auth.php';
