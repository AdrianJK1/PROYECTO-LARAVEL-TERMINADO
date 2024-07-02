<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/bloqueada', function () {
    return view('home');
})->middleware('auth_docentes');

Route::get('/bloqueada', function () {
    return view('home');
})->middleware('auth_estudiantes');


require __DIR__.'/docente_routes.php';
require __DIR__.'/grupo_routes.php';
require __DIR__.'/docente_grupos_routes.php';
require __DIR__.'/estudiante_route.php';
require __DIR__.'/estudiante_grupos_route.php';
require __DIR__.'/asistencias_route.php';
