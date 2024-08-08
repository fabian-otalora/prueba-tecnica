<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});


Route::controller(TaskController::class)->group(function () {
    // Listar todas las tareas.
    Route::get('/tasks', 'getTask');

    // Crear una nueva tarea.
    Route::post('/tasks', 'saveTask');

    // Mostrar detalles de una tarea específica.
    Route::get('/tasks/{id}', 'getIdTask');

    // Actualizar una tarea específica.
    Route::put('/tasks/{id}','putTask');

    // Eliminar una tarea específica.
    Route::delete('/tasks/{id}', 'deleteTask');

    // Filtro por fecha.
    Route::get('/tasks/filters/date/{date}', 'filterByDate');
}); 




