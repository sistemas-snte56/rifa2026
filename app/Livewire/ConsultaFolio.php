<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ConsultaFolio extends Component
{

    public $numero_personal;
    public $resultado = null;

    protected $rules = [
        'numero_personal' => 'required|numeric',
    ];


    public function consultar()
    {
        $this->resetErrorBag(); // Limpia errores anteriores
        $this->resultado = null; // Limpia el resultado previo para forzar el refresco

        $this->validate([
            'numero_personal' => 'required|string',
        ]);

        $busqueda = trim($this->numero_personal);

        // Buscamos al participante
        $registro = DB::table('participantes')
            ->join('padron_bases', 'participantes.padron_base_id', '=', 'padron_bases.id')
            ->where(function($query) use ($busqueda) {
                $query->where('padron_bases.numero_personal', '=', $busqueda) // Busca exacto (0087662)
                    ->orWhere('padron_bases.numero_personal', '=', (int)$busqueda); // Busca como entero (87662)
            })
            ->select('participantes.folio', 'padron_bases.nombre_completo', 'padron_bases.numero_personal as np_real')
            ->first();

        if ($registro) {
            $this->resultado = [
                'status' => 'success',
                'mensaje' => '¡Registro confirmado!',
                'folio' => $registro->folio,
                'nombre' => $registro->nombre_completo,
                'identificador' => $registro->np_real // Para que el usuario vea que sí es él
            ];
        } else {
            $this->resultado = [
                'status' => 'error',
                'mensaje' => "No se encontró registro para: {$busqueda}. Si eres jubilado, intenta sin los ceros iniciales."
            ];
        }
    } 







    public function render()
    {
        return view('livewire.consulta-folio')->layout('layouts.guest');
    }
}
