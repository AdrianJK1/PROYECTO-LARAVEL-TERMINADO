<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AsistenciaController;



Route::group(['prefix' => 'estudiantes' ,'middleware' => 'auth_estudiantes'], function () {
    Route::get('/', [EstudianteController::class, 'index'])->name('estudiantes.index');
    Route::get('/show/{id}', [EstudianteController::class, 'show'])->name('estudiantes.show');
    Route::get('/create', [EstudianteController::class, 'create'])->name('estudiantes.create');
    Route::post('/create', [EstudianteController::class, 'store'])->name('estudiantes.store');
    Route::get('/edit/{id}', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
    Route::post('/edi/{id}', [EstudianteController::class, 'update'])->name('estudiantes.update');
    Route::get('/delete/{id}', [EstudianteController::class, 'delete'])->name('estudiantes.delete');
    Route::post('/delete/{id}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');
});


Route::group(['prefix' => 'asistencias', 'middleware' => 'auth_estudiantes'], function () {
    Route::get('/', [AsistenciaController::class, 'index'])->name('asistencias.index');
    Route::get('/show/{id}', [AsistenciaController::class, 'show'])->name('asistencias.show');
    Route::get('/create', [AsistenciaController::class, 'create'])->name('asistencias.create');
    Route::post('/create', [AsistenciaController::class, 'store'])->name('asistencias.store');
    Route::get('/edit/{id}', [AsistenciaController::class, 'edit'])->name('asistencias.edit');
    Route::post('/edit/{id}', [AsistenciaController::class, 'update'])->name('asistencias.update');
    Route::get('/delete/{id}', [AsistenciaController::class, 'delete'])->name('asistencias.delete');
    Route::post('/delete/{id}', [AsistenciaController::class, 'destroy'])->name('asistencias.destroy');
});


Route::get('estudiantes/login', [EstudianteController::class, 'showLoginForm'])->name('estudiantes.showLoginForm');
Route::post('estudiantes/login', [EstudianteController::class, 'login'])->name('estudiantes.login');
Route::get('estudiantes/logout', [EstudianteController::class, 'logout'])->name('estudiantes.logout');
