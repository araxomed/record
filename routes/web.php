<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/login', [Controller::class, 'login'])->name('login');
Route::post('/login/auth', [Controller::class, 'authLogin'])->name('login.auth');
Route::get('/logout', [Controller::class, 'logout'])->name('logout');

Route::get('/', [Controller::class, 'dashboard'])->name('inicio');
Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
Route::get('/jobs', [Controller::class, 'jobs'])->name('jobs');
// Route::middleware(['authorize_api'])->group(function(){
// });
