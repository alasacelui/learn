<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\All\ProfileController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TmpImageUploadController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\User\DashboardController;

Route::resource('/', MainController::class);

Route::get('/course/{course}', [CourseController::class,'show'])->name('course.show');


Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function() {
    Route::resource('course', CourseController::class)->except('show');
    Route::resource('category', CategoryController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
});

// User
Route::group(['middleware' => 'auth'], function() {
    // TMP FILE UPLOAD
    Route::delete('tmp_upload/revert', [TmpImageUploadController::class, 'revert']);
    Route::resource('tmp_upload', TmpImageUploadController::class);

    // PROFILE
    Route::resource('profile', ProfileController::class)->parameter('profile', 'user');

    // User Dashboard
    Route::resource('dashboard', DashboardController::class);
});

Auth::routes();


