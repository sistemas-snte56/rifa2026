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


// Route::any('{any}', function () {
//     return redirect()->away('https://snte56.org.mx/');
// })->where('any', '^(?!admin).*$'); // Esto significa: Redirecciona todo lo que NO empiece con "ad