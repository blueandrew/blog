<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/Welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', [HomeController::class, 'edit'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'edit'])->middleware(['auth', 'verified'])->name('dashboard.edit');
Route::get('/dashboard/works', [DashboardController::class, 'works'])->name('dashboard.get');
Route::patch('/dashboard{id}', [DashboardController::class, 'update'])->name('dashboard.update');
Route::post('/dashboard', [DashboardController::class, 'add'])->name('dashboard.add');
Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/test',function(){
    $query = DB::table('works')->get();
    return $query;
});

require __DIR__.'/auth.php';
