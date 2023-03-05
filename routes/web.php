<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use App\Models\Department;
use App\Models\User;
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

Route::get('/test',function(){
    // $data = User::whereBetween('id',[26,29])->select('id')->get();
    // $department = Department::find(7);
    // $department->users()->attach($data);
});

Route::get('scanner',function(){
    return view('qrscanner');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->middleware('verified')->name('dashboard');
    Route::get('/qrcode/{user}', [QrCodeController::class,'index'])->name('qrcode');

    Route::resource('attendance',AttendanceController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
