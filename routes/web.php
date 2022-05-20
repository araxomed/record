<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\GeneralController;

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
Route::get('/', [RecordController::class, 'panel'])->name('main');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/inicio', [RecordController::class, 'inicio'])->name('inicio');
    Route::get('/poblacion', [RecordController::class, 'poblacion'])->name('poblacion');
    Route::post('/poblacion/save', [RecordController::class, 'vueSavePeople'])->name('poblacion.save');
    Route::post('/poblacion/remove', [RecordController::class, 'vueRemovePeople'])->name('poblacion.remove');
    Route::get('/encuestas', [RecordController::class, 'showForms'])->name('encuestas');
    Route::get('/encuesta/{id}/registros', [RecordController::class, 'showRecords'])->name('encuesta.registro');
    Route::get('/encuesta/{id}/diligenciamiento', [RecordController::class, 'showFilled'])->name('encuesta.fillable');
    Route::get('/encuesta/{id}/estadistica', [RecordController::class, 'showEstadistica'])->name('encuesta.estadistica');
    Route::get('/encuesta/{id}/dashboard', [RecordController::class, 'showDashboard'])->name('encuesta.dashboard');
    Route::post('/poll/item/statistic', [RecordController::class, 'vueItemStatistic'])->name('poll.item.statistic');
    Route::get('/encuesta/{id}/all', [RecordController::class, 'excelData'])->name('poll.excell');

    Route::post('/vue/mimetic', [GeneralController::class, 'mimeticSearch'])->name('mimetic');
});

Route::get('/panel/{cc?}', [RecordController::class, 'panel'])->name('panel');
Route::get('/encuesta/{id}/{cc}/show', [RecordController::class, 'encuestaShow'])->name('poll.show');      // write and show
Route::get('/encuesta/{id}/{cc}/edit', [RecordController::class, 'encuestaEdit'])->name('poll.edit');

Route::post('/vue/form', [RecordController::class, 'vueGetForm'])->name('vue.form');
Route::post('/vue/form/write', [RecordController::class, 'vueWriteForm'])->name('vue.form.write');
