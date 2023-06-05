<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\HobbieController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UsuarioController::class, 'create'])->name('usuarios.create');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::get('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

Route::get('/estados', [EstadoController::class, 'index'])->name('estados.index');
Route::get('/estados/{estado}', [EstadoController::class, 'show'])->name('estados.show');

Route::get('/cidades', [CidadeController::class, 'index'])->name('cidades.index');
Route::get('/cidades/{cidade}', [CidadeController::class, 'show'])->name('cidades.show');
Route::get('/cidadesestados/{estadoId}', [CidadeController::class, 'getCidadesPorEstado']);


Route::get('/hobbies', [HobbieController::class, 'index'])->name('hobbies.index');
Route::get('/hobbies/{hobbie}', [HobbieController::class, 'show'])->name('hobbies.show');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


