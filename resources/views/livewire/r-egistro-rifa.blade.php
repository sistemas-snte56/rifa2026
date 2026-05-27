<div class="w-full max-w-2xl mx-auto mt-5 mb-5 px-4 py-4 sm:px-6 rounded-xl overflow-hidden border border-gray-200">

    {{-- HEADER --}}
    <div class="px-4 py-4 text-center" style="background:#ee7a00;">
        <h2 class="text-3xl font-bold text-white mb-2 uppercase">
            Registro Rifa 2026
        </h2>

        <p class="text-base font-semibold text-white">
            Ingresa tus datos para obtener tu folio
        </p>

        {{-- Step dots --}}
        <div class="flex justify-center gap-2 mt-5">
            <div class="w-2.5 h-2.5 rounded-full transition-all"
                style="background: {{ $paso_dos ? '#ee7a00' : '#ff5608' }}">
            </div>

            <div class="w-2.5 h-2.5 rounded-full transition-all"
                style="background: {{ $paso_dos ? '#ff5608' : 'rgba(255,255,255,0.2)' }}">
            </div>

            <div class="w-2.5 h-2.5 rounded-full" style="background:rgba(255,255,255,0.2)">
            </div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="bg-white px-5 sm:px-8 py-8">

        <form wire:submit.prevent="registrar">

            {{-- PASO 1 --}}
            <div class="mb-6">

                <label class="block text-base font-medium mb-4 tracking-wide" style="color:#353a40;">

                    Ingresa tu número de personal.

                </label>

                {{-- INPUT + BOTÓN RESPONSIVE --}}
                <div class="flex flex-col sm:flex-row gap-2">

                    <input type="tel" wire:model="numero_personal" wire:keydown.enter.prevent="buscarPersona" placeholder="Ej. 123456"
                        class="flex-1 w-full px-4 py-3 text-base rounded-lg border outline-none transition focus:ring-2"
                        style="border-color:#d1d5db; --tw-ring-color:#ee7a0055;" />

                    
                        
                    <button type="button" wire:click="buscarPersona" wire:loading.attr="disabled" wire:target="buscarPersona"
                        class="w-full sm:w-auto px-5 py-3 text-base font-medium text-white rounded-lg transition flex items-center justify-center min-w-[120px]"
                        style="background:#89194b;" onmouseover="this.style.background='#6a143a'"
                        onmouseout="this.style.background='#89194b'">

                        
                        <span wire:loading.remove wire:target="buscarPersona">Buscar</span>
                        <span wire:loading wire:target="buscarPersona">Buscando...</span>

                    </button>








                </div>

                @error('numero_personal')
                <p class="mt-4 text-sm px-3 py-2 rounded-lg"
                    style="background:#fff0f3; color:#89194b; border:0.5px solid #9d244966;">

                    {{ $message }}

                </p>
                @enderror

            </div>

            {{-- BIENVENIDA --}}
            @if($nombre_encontrado)

            <div class="flex flex-col items-center justify-center gap-1 text-center text-base px-4 py-2 rounded-lg mb-6"
                style="background:#fff7f0; border:0.5px solid #ee7a0066; color:#9d2449;">

                <i class="ti ti-circle-check" style="font-size:20px; color:#ff5608;">
                </i>

                <span>Hola,</span>

                <strong>{{ $nombre_encontrado }}</strong>

            </div>

            {{-- ALERTA --}}
            <div class="flex items-start gap-3 border-l-4 border-orange-500 bg-orange-50 p-4 rounded-lg mb-4">

                <i class="ti ti-info-circle text-orange-500 text-2xl"></i>

                <div>

                    <h3 class="font-semibold text-orange-800">
                        Completa la información solicitada
                    </h3>

                    <p class="text-sm text-orange-700 mt-1">
                        Verifica que todos los campos estén correctamente llenados antes de continuar.
                    </p>

                </div>

            </div>

            @endif

            @error('padron_id')
            <p class="text-sm px-3 py-2 rounded-lg mb-5"
                style="background:#fff0f3; color:#89194b; border:0.5px solid #9d244966;">

                {{ $message }}

            </p>
            @enderror






            @if(count($posibles_personas) > 0)
                <div class="mt-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg shadow-sm">
                    <p class="text-sm text-blue-800 font-bold mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        Se encontraron múltiples registros por existir coincidencias entre activo y jubilado, por favor seleccione el correcto.
                    </p>
                    
                    <div class="grid gap-2">
                        @foreach($posibles_personas as $p)
                            @php
                                $yaRegistrado = \App\Models\Participante::where('padron_base_id', $p->id)->exists();
                            @endphp

                            <button 
                                type="button" 
                                @if(!$yaRegistrado) wire:click="seleccionarPersona({{ $p->id }})" @endif
                                @class([
                                    'w-full text-left p-3 rounded-lg border flex justify-between items-center transition-all duration-200',
                                    'bg-white border-gray-200 hover:border-blue-400 hover:bg-blue-50 shadow-sm' => !$yaRegistrado,
                                    'bg-gray-100 border-gray-300 opacity-60 cursor-not-allowed' => $yaRegistrado,
                                ])
                            >
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-800">{{ $p->nombre_completo }}</span>
                                    <span class="text-xs text-gray-500">ID de sistema: {{ $p->numero_personal }}</span>
                                </div>

                                @if($yaRegistrado)
                                    <span class="text-[10px] font-bold bg-red-100 text-red-600 px-2 py-1 rounded-full uppercase tracking-wider">
                                        Ya registrado
                                    </span>
                                @else
                                    <span class="text-[10px] font-bold bg-green-100 text-green-600 px-2 py-1 rounded-full uppercase tracking-wider">
                                        Disponible
                                    </span>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif








            {{-- PASO 2 --}}
            @if($paso_dos)

            <div class="space-y-5 pt-4 border-t" style="border-color:#f3f4f6;">

                {{-- REGIÓN --}}
                <div>

                    <label class="block text-base font-medium mb-2 tracking-wide" style="color:#353a40;">

                        Región

                    </label>

                    <select wire:model.live="selectIdRegion"
                        class="w-full px-4 py-3 text-base rounded-lg border outline-none transition focus:ring-2"
                        style="border-color:#d1d5db;">

                        <option value="">Selecciona...</option>

                        @foreach($regiones as $region)
                        <option value="{{ $region->id }}">
                            {{ $region->nombre }}
                        </option>
                        @endforeach

                    </select>

                    @error('selectIdRegion')
                    <p class="mt-1 text-sm" style="color:#89194b;">

                        {{ $message }}

                    </p>
                    @enderror

                </div>

                {{-- DELEGACIÓN --}}
                <div>

                    <label class="block text-base font-medium mb-2 tracking-wide" style="color:#353a40;">

                        Delegación

                    </label>

                    <select wire:model.live="selectIdDelegacion" @if(!$selectIdRegion) disabled @endif
                        class="w-full px-4 py-3 text-base rounded-lg border outline-none transition disabled:opacity-40 disabled:cursor-not-allowed"
                        style="border-color:#d1d5db;">

                        <option value="">Selecciona...</option>

                        @if($selectIdRegion)

                            @foreach($delegaciones as $delegacion)

                            <option value="{{ $delegacion->id }}">
                                {{ $delegacion->nombre_completo }}
                            </option>

                            @endforeach

                        @endif

                    </select>

                    @error('selectIdDelegacion')
                    <p class="mt-1 text-sm" style="color:#89194b;">

                        {{ $message }}

                    </p>
                    @enderror

                </div>

                {{-- GÉNERO + TELÉFONO RESPONSIVE --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- GÉNERO --}}
                    <div>

                        <label class="block text-base font-medium mb-2 tracking-wide" style="color:#353a40;">

                            Género

                        </label>

                        <select wire:model="genero" class="w-full px-4 py-3 text-base rounded-lg border outline-none"
                            style="border-color:#d1d5db;">

                            <option value="">Selecciona...</option>
                            <option value="H">Hombre</option>
                            <option value="M">Mujer</option>
                            <option value="O">Otro</option>

                        </select>

                        @error('genero')
                        <p class="mt-1 text-sm" style="color:#89194b;">

                            {{ $message }}

                        </p>
                        @enderror

                    </div>

                    {{-- TELÉFONO --}}
                    <div>

                        <label class="block text-base font-medium mb-2 tracking-wide" style="color:#353a40;">

                            Teléfono

                        </label>


                        <input type="tel" 
                            wire:model="telefono" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" {{-- <--- Bloquea letras y espacios al escribir --}}
                            maxlength="10"
                            class="w-full px-4 py-3 text-base rounded-lg border outline-none" 
                            placeholder="Ej. 1234567890"
                            style="border-color:#d1d5db;">    

                        @error('telefono')
                        <p class="mt-1 text-sm" style="color:#89194b;">

                            {{ $message }}

                        </p>
                        @enderror

                    </div>

                </div>

                {{-- EMAIL --}}
                <div>

                    <label class="block text-base font-medium mb-2 tracking-wide" style="color:#353a40;">

                        Correo electrónico

                    </label>

                    <input type="email" wire:model="email" placeholder="tu@correo.com"
                        class="w-full px-4 py-3 text-base rounded-lg border outline-none"
                        style="border-color:#d1d5db;" />

                    @error('email')
                    <p class="mt-1 text-sm" style="color:#89194b;">

                        {{ $message }}

                    </p>
                    @enderror

                </div>

                {{-- BOTÓN --}}
                <button type="submit"
                    class="w-full py-4 text-base font-medium text-white rounded-lg transition mt-2 flex items-center justify-center gap-2"
                    style="background:#ff5608;" onmouseover="this.style.background='#ee7a00'"
                    onmouseout="this.style.background='#ff5608'">

                    <i class="ti ti-ticket" style="font-size:18px;">
                    </i>

                    Generar mi folio

                </button>

            </div>

            @endif

        </form>

        {{-- BOTÓN PARA VOLVER O CERRAR --}}
        <div class="mt-10 text-center">
            <a href="{{ route('consulta') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition flex items-center justify-center gap-2">
                {{-- SVG DE LUPA DE BÚSQUEDA --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-hover:scale-110" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                    <path d="M21 21l-6 -6" />
                    <path d="M7 10l2 2l4 -4" /> {{-- Este check dentro de la lupa indica "verificación" --}}
                </svg>
                <span>¿Ya te registraste pero no viste tu folio? <strong>Consúltalo aquí.</strong></span>
            </a>
        </div>

    </div>



</div>