<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('courses.index');
});

Route::resource('courses', CourseController::class)
    ->except(['show']);

Route::resource('students', StudentController::class)
    ->except(['show']);