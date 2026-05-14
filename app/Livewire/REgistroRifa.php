<?php

namespace App\Livewire;

use App\Models\Delegacion;
use App\Models\PadronBase;
use App\Models\Participante;
use App\Models\Region;
use Illuminate\Support\Str;
use Livewire\Component;

class RegistroRifa extends Component
{
    // Propiedades que se amarran a la vista (wire:model)
    public $numero_personal = '';
    public $nombre_encontrado = '';
    public $padron_id = '';
    public $genero = '', $telefono = '', $email = '', $delegacion_id = '';
    
    public $regiones = [];  
    public $delegaciones = [];  

    public $selectIdRegion = null;
    public $selectIdDelegacion = null;

    public function updatedSelectIdRegion($value)
    {
        // Resetear delegación seleccionada
        $this->selectIdDelegacion = null;

        // Cargar delegacines de la región
        $this->delegaciones = Delegacion::where('region_id', $value)->orderBy('delegacion')->get();
    }




    public $paso_dos = false;

    // Se ejecuta cada vez que el numero_personal cambia en la vista
    public function buscarPersona()
    {
        $this->paso_dos = false; // Resetear paso 2 cada vez que se busque un nuevo número
        $this->nombre_encontrado = ''; // Limpiar nombre encontrado
        $this->padron_id = ''; // Limpiar padron_id anterior

        $this->validate([
            'numero_personal' => 'required|numeric',
        ], [
            'numero_personal.required' => 'El número de personal es obligatorio.',
            'numero_personal.numeric' => 'El número de personal debe ser numérico.',
        ]);

        // 1. Quitamos ceros que el usuario haya escrito (ej. "00123" -> "123")
        $soloNumeros = ltrim($this->numero_personal, '0');

        // 2. Creamos la versión de 7 dígitos (ej. "123" -> "0000123")
        $conCeros = str_pad($soloNumeros, 7, "0", STR_PAD_LEFT);

        // 3. Buscamos AMBAS posibilidades al mismo tiempo
        $registro = PadronBase::whereIn('numero_personal', [$soloNumeros, $conCeros])
                            ->first();

        /*
            if ($registro) {
                // ✅ Verificar si ya tiene folio ANTES de mostrar el paso 2
                $yaRegistrado = Participante::where('padron_base_id', $registro->id)->exists();

                if ($yaRegistrado) {
                    $this->addError('numero_personal', 'Este número de personal ya tiene un folio asignado.');
                    return;
                }

                $this->nombre_encontrado = $registro->nombre_completo;
                $this->padron_id = $registro->id;
                $this->paso_dos = true;
            } else {
                $this->addError('numero_personal', 'No se encontró ese número personal.');
            }
        */

        if ($registro) {
            // ✅ Verificar si ya tiene folio ANTES de mostrar el paso 2
            $yaRegistrado = Participante::where('padron_base_id', $registro->id)->exists();

            if ($yaRegistrado) {
                $this->addError('numero_personal', 'Este número de personal ya tiene un folio asignado.');
                return;
            }
            $this->nombre_encontrado = $registro->nombre_completo;
            $this->padron_id = $registro->id;
            $this->paso_dos = true;
            $this->resetErrorBag('numero_personal'); // Limpiar errores anteriores
        } else {
            $this->nombre_encontrado = '';
            $this->padron_id = '';
            $this->paso_dos = false;
            $this->addError('numero_personal', 'No se encontró el número: ' . $this->numero_personal);
        }
    }

 

    public function mount()
    {
        $this->regiones = Region::orderBy('id')->get();
    }



    public function registrar()
    {
        // Limpiamos el teléfono de espacios, guiones o paréntesis antes de validar
        // $this->telefono = preg_replace('/[^0-09]/', '', $this->telefono);

        // dd($this->telefono);

        // 1. Validar los datos
        $this->validate([
            'genero' => 'required',
            'telefono' => 'required|digits:10|numeric',
            'email' => 'required|email',
            'selectIdDelegacion' => 'required',
            'padron_id' => 'required|unique:participantes,padron_base_id', // Evita doble registro
        ], [
            'padron_id.unique' => 'Este número de personal ya tiene un folio asignado.',
            'genero.required' => 'El género es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
            'telefono.numeric' => 'El télefono debe de ser númerico.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'selectIdDelegacion.required' => 'La delegación es obligatoria.',
        ]);

        // dd($this->padron_id, $this->selectIdDelegacion, $this->genero, $this->telefono, $this->email);

        // 2. Crear el participante (El modelo generará el Folio solo gracias al evento que hicimos ayer)


        try {
            $nuevoParticipante = Participante::create([
                'padron_base_id' => $this->padron_id,
                'delegacion_id' => $this->selectIdDelegacion,
                'genero' => $this->genero,
                'telefono' => $this->telefono,
                'email' => $this->email,
            ]);
    
            // 3. Redireccionar o mostrar éxito con el Folio
            session()->flash('mensaje', '¡Registro exitoso!');
            session()->flash('folio', $nuevoParticipante->folio);
 
            
            


// ACCEDEMOS AL NOMBRE DESDE LA RELACIÓN Y LO PASAMOS A LA SESIÓN
    // Importante: Usamos el nombre del método que definiste en tu modelo: padronBase
    session()->flash('nombre', $nuevoParticipante->padronBase->nombre_completo);















            
            return redirect()->to('/exito'); // O puedes mostrarlo en la misma pantalla
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', 'Ocurrió un error al registrar. Intenta de nuevo.');
        }






    }

    public function render()
    {
        return view('livewire.r-egistro-rifa', [
            'delegaciones' => Delegacion::orderBy('delegacion')->get()
        ])->layout('layouts.guest');
    }
}