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

// Admin Group Middleware
Route::middleware(['auth','role:admin'])->group(function(){ // admin middleware
    Route::get('/admin/dashboard',[\App\Http\Controllers\AdminController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[\App\Http\Controllers\AdminController::class,'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile',[\App\Http\Controllers\AdminController::class,'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[\App\Http\Controllers\AdminController::class,'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[\App\Http\Controllers\AdminController::class,'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password',[\App\Http\Controllers\AdminController::class,'adminUpdatePassword'])->name('admin.update.password');
    Route::post('/admin/update/password',[\App\Http\Controllers\AdminController::class,'adminUpdatePassword'])->name('admin.update.password');
});

// Agent Group Middleware
Route::middleware(['auth','role:agent'])->group(function(){ // agent middleware
    Route::get('/agent/dashboard',[\App\Http\Controllers\AgentController::class,'agentDashboard'])->name('agent.dashboard');
});

// Property Type
Route::get('/admin/login',[\App\Http\Controllers\AdminController::class,'adminLogin'])->name('admin.login');

Route::middleware(['auth','role:admin'])->group(function(){ // admin middleware
    Route::controller(\App\Http\Controllers\Backend\PropertyTypeController::class)->group(function(){
       Route::get('/all/type','AllType')->name('all.type');
       Route::get('/add/type','AddType')->name('add.type');
       Route::post('/store/type','StoreType')->name('store.type');
       Route::get('/edit/type/{id}','EditType')->name('edit.type');
       Route::post('/update/type','UpdateType')->name('update.type');
       Route::get('/delete/type/{id}','DestroyType')->name('delete.type');
    });
});