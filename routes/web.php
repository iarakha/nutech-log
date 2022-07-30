<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\JenisMasalahController;
use App\Http\Controllers\WoController;
use App\Http\Controllers\OpenTaskController;
use App\Http\Controllers\ReportController;

Route::get('/', [AuthController::class, 'view'])->name('sign-in');
Route::post('/sign-in', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/sign-out', [AuthController::class, 'destroy'])->name('sign-out');


Route::get('/sign-up', [AuthController::class, 'register_view']) -> name('');
Route::post('/sign-up/register', [AuthController::class, 'store_register']) -> name('register');


Route::middleware('auth')->group(function () {
    
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'view']);
    
    //route user management
    Route::get('/user', [UserController::class, 'index']) -> name('user');
    Route::get('/user/add', [UserController::class, 'form']) -> name('add-user');
    Route::post('/user/save', [UserController::class, 'store']) -> name('save-user');
	Route::get('/user/{id}/edit', [UserController::class, 'form'])->name('user-edit');
	Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user-edit-save');
	Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user-delete');


    //route lokasi
    Route::get('/lokasi', [LokasiController::class, 'index']) -> name('lokasi');
    Route::get('/lokasi/add', [LokasiController::class, 'form']) -> name('add-lokasi');
    Route::post('/lokasi/save', [LokasiController::class, 'store']) -> name('save-lokasi');
	Route::get('/lokasi/{id}/edit', [LokasiController::class, 'form'])->name('lokasi-edit');
	Route::post('/lokasi/{id}/update', [LokasiController::class, 'update'])->name('lokasi-edit-save');
	Route::get('/lokasi/delete/{id}', [LokasiController::class, 'destroy'])->name('lokasi-delete');
    
    // route perangkat
    Route::get('/perangkat', [PerangkatController::class, 'index']) -> name('perangkat');
    Route::get('/perangkat/add', [PerangkatController::class, 'form']) -> name('add-perangkat');
    Route::post('/perangkat/save', [PerangkatController::class, 'store']) -> name('save-perangkat');
	Route::get('/perangkat/{id}/edit', [PerangkatController::class, 'form'])->name('perangkat-edit');
	Route::post('/perangkat/{id}/update', [PerangkatController::class, 'update'])->name('perangkat-edit-save');
	Route::get('/perangkat/delete/{id}', [PerangkatController::class, 'destroy'])->name('perangkat-delete');


    //route part
    Route::get('/part', [PartController::class, 'index']) -> name('part');
    Route::get('/part/add', [PartController::class, 'form']) -> name('add-part');
    Route::post('/part/save', [PartController::class, 'store']) -> name('save-part');
	Route::get('/part/{id}/edit', [PartController::class, 'form'])->name('part-edit');
	Route::post('/part/{id}/update', [PartController::class, 'update'])->name('part-edit-save');
	Route::get('/part/delete/{id}', [PartController::class, 'destroy'])->name('part-delete');

    //route jenis masalah
    Route::get('/jenis_masalah', [JenisMasalahController::class, 'index']) -> name('jenis_masalah');
    Route::get('/jenis_masalah/add', [JenisMasalahController::class, 'form']) -> name('add-jenis_masalah');
    Route::post('/jenis_masalah/save', [JenisMasalahController::class, 'store']) -> name('save-jenis_masalah');
	Route::get('/jenis_masalah/{id}/edit', [JenisMasalahController::class, 'form'])->name('jenis_masalah-edit');
	Route::post('/jenis_masalah/{id}/update', [JenisMasalahController::class, 'update'])->name('jenis_masalah-edit-save');
	Route::get('/jenis_masalah/delete/{id}', [JenisMasalahController::class, 'destroy'])->name('jenis_masalah-delete');


    //route input ticket
    Route::get('/wo', [WoController::class, 'index']) -> name('wo');
    Route::get('/wo/add', [WoController::class, 'form']) -> name('add-wo');
    Route::post('/wo/save', [WoController::class, 'store']) -> name('save-wo');
	Route::get('/wo/{id}/edit', [WoController::class, 'form'])->name('wo-edit');
	Route::post('/wo/{id}/update', [WoController::class, 'update'])->name('wo-edit-save');
	Route::get('/wo/delete/{id}', [WoController::class, 'destroy'])->name('wo-delete');

    //route Open Task
    Route::get('/open_task', [OpenTaskController::class, 'index']) -> name('open_task');
    Route::get('/open_task/add', [OpenTaskController::class, 'form']) -> name('add-open_task');
    Route::post('/open_task/save', [OpenTaskController::class, 'store']) -> name('save-open_task');
    Route::get('/open_task/{id}/edit', [OpenTaskController::class, 'form'])->name('open_task-edit');
    Route::post('/open_task/{id}/update', [OpenTaskController::class, 'update'])->name('open_task-edit-save');
    Route::get('/open_task/delete/{id}', [OpenTaskController::class, 'destroy'])->name('open_task-delete');

    Route::get('/report', [ReportController::class, 'index']) -> name('report');
    Route::get('/report/export', [ReportController::class, 'export']) -> name('report-export');
    

    // change status
    Route::post('/open_task/save', [OpenTaskController::class, 'progress']) -> name('progress-task');

    Route::post('/wo/done', [WoController::class, 'done']) -> name('wo-done');
    Route::post('/wo/open', [WoController::class, 'open']) -> name('wo-open');
});


