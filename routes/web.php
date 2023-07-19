<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

Route::middleware(['auth','role:admin'])->group(function(){ // admin middleware
    Route::get('/admin/dashboard',[\App\Http\Controllers\AdminController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[\App\Http\Controllers\AdminController::class,'adminLogout'])->name('admin.logout');
});

Route::middleware(['auth','role:agent'])->group(function(){ // agent middleware
    Route::get('/agent/dashboard',[\App\Http\Controllers\AgentController::class,'agentDashboard'])->name('agent.dashboard');
});
Route::get('/admin/login',[\App\Http\Controllers\AdminController::class,'adminLogin'])->name('admin.login');
