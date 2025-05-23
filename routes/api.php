<?php

use App\Http\Controllers\File\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/arquivo/upload', [FileController::class, 'upload'])->name('file.upload')
    ->middleware('set.max.execution.time');

Route::get('/arquivo/buscar', [FileController::class, 'getByFilter'])->name('file.get-by-filter');
Route::get('/arquivo/buscar-conteudo', [FileController::class, 'getContentByFilter'])->name('file.get-content');
Route::get('/arquivo/buscar-todos', [FileController::class, 'getAll'])->name('file.get-all');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
