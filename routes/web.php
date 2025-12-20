<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Domains\Core\Http\Controllers\DashboardController;
use App\Domains\Core\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

 

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dss-dashboard', [DashboardController::class, 'index'])->name('dss.dashboard');

    Route::resource('departments', DepartmentController::class)->names('departments');
    Route::resource('sectors', \App\Domains\Core\Http\Controllers\SectorController::class)->names('sectors');
    Route::resource('sub-sectors', \App\Domains\Core\Http\Controllers\SubSectorController::class)->names('sub-sectors');
    Route::resource('main-programs', \App\Domains\Core\Http\Controllers\MainProgramController::class)->names('main-programs');
    Route::resource('programs', \App\Domains\Core\Http\Controllers\ProgramController::class)->names('programs');
    Route::resource('program-budgets', \App\Domains\Core\Http\Controllers\ProgramBudgetsController::class)->names('program-budgets');
    Route::resource('indicators', \App\Domains\Core\Http\Controllers\IndicatorController::class)->names('indicators');
    Route::resource('program-indicator-links', \App\Domains\Core\Http\Controllers\ProgramIndicatorLinkController::class)->names('program-indicator-links');
    Route::resource('evaluations', \App\Domains\Core\Http\Controllers\EvaluationController::class)->names('evaluations');
    Route::resource('kpi-snapshots', \App\Domains\Core\Http\Controllers\KpiSnapshotController::class)->names('kpi-snapshots');

});


require __DIR__ . '/auth.php';
