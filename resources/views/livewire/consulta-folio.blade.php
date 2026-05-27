<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-10 border border-gray-100">
        
        <form wire:submit.prevent="consultar" class="w-full mx-auto">
            
            {{-- ENCABEZADO --}}
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold tracking-tight" style="color:#89194b;">
                    Consulta de Folio
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Verifica tu participación en la Rifa 2026.
                </p>
            </div>

            {{-- CAMPO DE BÚSQUEDA --}}
            <div class="mb-6">
                <label class="block text-base font-medium mb-4 tracking-wide" style="color:#353a40;">
                    Ingresa tu número de personal.
                </label>

                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="text" 
                        wire:model.defer="numero_personal" 
                        placeholder="Ej. 0087662"
                        class="flex-1 w-full px-4 py-3 text-base rounded-lg border outline-none transition focus:ring-2"
                        style="border-color:#d1d5db; --tw-ring-color:#ee7a0055;" />

                    <button type="submit" 
                        wire:loading.attr="disabled" 
                        wire:target="consultar"
                        class="w-full sm:w-auto px-8 py-3 text-base font-medium text-white rounded-lg transition flex items-center justify-center gap-2"
                        style="background:#89194b;" 
                        onmouseover="this.style.background='#6a143a'"
                        onmouseout="this.style.background='#89194b'">
                        
                        <span wire:loading.remove wire:target="consultar">Buscar</span>
                        <span wire:loading wire:target="consultar">Buscando...</span>
                    </button>
                </div>

                <p class="text-[11px] text-gray-400 mt-2 italic leading-tight">
                    * Activos: usar 7 dígitos (ej. 0087662) <br>
                    * Jubilados: usar número sin ceros iniciales (ej. 87662)
                </p>

                @error('numero_personal')
                <p class="mt-4 text-sm px-3 py-2 rounded-lg" 
                    style="background:#fff0f3; color:#89194b; border:0.5px solid #9d244966;">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <hr class="mb-6 border-gray-100">

            {{-- SECCIÓN DE RESULTADOS --}}
            @if($resultado)
                <div wire:key="res-{{ rand() }}" class="animate-fade-in">
                    
                    @if($resultado['status'] == 'success')
                        {{-- TARJETA DE ÉXITO --}}
                        <div class="space-y-4">
                            <div class="flex flex-col items-center justify-center gap-2 text-center p-6 rounded-xl border-2"
                                style="background:#fff7f0; border-color:#ee7a0066; color:#9d2449;">
                                
                                {{-- SVG NATIVO DEL TICKET --}}
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" style="color:#ff5608;" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M15 5l0 2" />
                                        <path d="M15 11l0 2" />
                                        <path d="M15 17l0 2" />
                                        <path d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                                    </svg>
                                </div>

                                <span class="text-sm uppercase tracking-widest font-medium text-gray-500">Folio Asignado</span>
                                <strong class="text-3xl font-black tracking-tighter" style="color:#89194b;">
                                    {{ $resultado['folio'] }}
                                </strong>
                            </div>

                            <div class="flex items-start gap-3 border-l-4 p-4 rounded-lg bg-gray-50" 
                                 style="border-color:#89194b;">
                                <div class="mt-1">
                                    <svg class="w-6 h-6" style="color:#89194b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800 uppercase text-sm">Confirmación de Registro</h3>
                                    <p class="text-lg text-gray-700 leading-tight">{{ $resultado['nombre'] }}</p>
                                    
                                </div>
                            </div>

                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                                <p class="text-xs text-blue-800 leading-relaxed">
                                    <strong>¡Todo listo!</strong> Tu registro está confirmado. No es necesario volver a llenar el formulario de inscripción. Puedes tomar una captura de pantalla de este folio.
                                </p>
                            </div>
                        </div>

                    @else
                        {{-- MENSAJE DE ERROR --}}
                        <div class="flex items-center gap-3 p-4 rounded-lg"
                            style="background:#fff0f3; color:#89194b; border:0.5px solid #9d244966;">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm font-medium">{{ $resultado['mensaje'] }}</p>
                        </div>
                    @endif

                </div>
            @endif

        </form>

    </div>
    
    {{-- BOTÓN PARA VOLVER O CERRAR --}}
    <div class="mt-6 text-center">
        <a href="{{ route('registro-rifa') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al inicio
        </a>
    </div>
</div>