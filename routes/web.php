<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileUploadController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

# admin

Route::middleware(['admin'])->group(function () {
    // Admin-only routes or actions
    Route::get('/category',[CategoryController::class,'index'])->name('category.index');
    Route::post('/category/add',[CategoryController::class,'add'])->name('category.add');
    Route::delete('/category/delete/{category_id}',[CategoryController::class,'delete'])->name('category.delete');
});

# tasks
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/all', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/view/{task_id}', [TaskController::class, 'main'])->name('tasks.main');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/create', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/edit/{task_id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/edit/{task_id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/tasks/update/status/{task_id}', [TaskController::class, 'editStatus'])->name('tasks.editstatus');
    Route::put('/tasks/update/status/{task_id}', [TaskController::class, 'updateStatus'])->name('tasks.updatestatus');
    Route::delete('/tasks/delete/{task_id}', [TaskController::class, 'remove'])->name('tasks.remove');

    #category
    Route::get('/category/all',[CategoryController::class,'show']);
});

# comments
Route::middleware(['auth'])->group(function () {
    Route::post('/comment/add/{task_id}', [CommentController::class, 'add'])->name('comments.add');
});

# mail

Route::get('/mail/send/{name}',[MailController::class,'index']);


# file handle
Route::post('/file/upload/{task_id}',[FileUploadController::class,'uploadFile']);
Route::get('/file/download/{task_id}/{filename}', [FileUploadController::class, 'download'])->name('document.download');
Route::get('/file/delete/{task_id}/{filename}', [FileUploadController::class, 'delete'])->name('document.download');
#demo
Route::get('/demo', [TaskController::class, 'demo']);
require __DIR__.'/auth.php';
