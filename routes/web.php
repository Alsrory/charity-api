<?php

use App\Http\Controllers\Api\IntiativeController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('p', function () {
    return view('add-project');
});
Route::post('proj', [ProjectController::class, 'store'])->name('projects.store');
Route::post('initaitives', [IntiativeController::class, 'store'])->name('initaitives.store');
Route::get('initaitives/show', [IntiativeController::class, 'index'])->name('initaitives.index');
Route::get('proj', [ProjectController::class, 'showView'])->name('projects.views');
Route::get('proj/show', [ProjectController::class, 'showproject'])->name('projects.shows');
Route::get('proj/show', [ProjectController::class, 'showproject'])->name('projects.shows');
Route::get("/initaitive",function(){
    return view('add-initaitive');
});



