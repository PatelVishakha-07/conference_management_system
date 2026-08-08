<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConferenceController as AdminConferenceController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ConferenceController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ConferenceController::class, 'home'])->name('home');
Route::get('/conferences', [ConferenceController::class, 'index'])->name('conferences.index');
Route::get('/conferences/archive', [ConferenceController::class, 'archive'])->name('conferences.archive');
Route::get('/conferences/{conference}', [ConferenceController::class, 'show'])->name('conferences.show');
Route::get('/departments/{code}', [ConferenceController::class, 'byDepartment'])->name('conferences.department');

Route::get('/submit', [SubmissionController::class, 'create'])->name('submissions.create');
Route::post('/submit', [SubmissionController::class, 'store'])->name('submissions.store');
Route::get('/submit/success/{submission}', [SubmissionController::class, 'success'])->name('submissions.success');
Route::post('/submit/{submission}/pay', [SubmissionController::class, 'pay'])->name('submissions.pay');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/submissions', [AdminController::class, 'submissions'])->name('submissions');
    Route::resource('conferences', AdminConferenceController::class)->except(['show']);
    Route::post('/submissions/{submission}/status', [AdminController::class, 'updateStatus'])->name('submissions.status');
});

