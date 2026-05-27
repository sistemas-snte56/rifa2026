<?php

use App\Livewire\ConsultaFolio;
use App\Livewire\REgistroRifa;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', REgistroRifa::class)->name('registro-rifa');
Route::get('/exito', function () {
    if (!session()->has('folio')) {
        return redirect()->route('registro-rifa');
    }
    return view('livewire.exito');
})->name('exito');
Route::get('/consultar-folio', ConsultaFolio::class)->name('consulta');