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

                    INGRESA TU NÚMERO DE PERSONAL

                </label>

                {{-- INPUT + BOTÓN RESPONSIVE --}}
                <div class="flex flex-col sm:flex-row gap-2">

                    <input type="text" wire:model="numero_personal" wire:keydown.enter.prevent="buscarPersona" placeholder="Ej. 123456"
                        class="flex-1 w-full px-4 py-3 text-base rounded-lg border outline-none transition focus:ring-2"
                        style="border-color:#d1d5db; --tw-ring-color:#ee7a0055;" />

                    <button type="submit" wire:click="buscarPersona"
                        class="w-full sm:w-auto px-5 py-3 text-base font-medium text-white rounded-lg transition"
                        style="background:#89194b;" onmouseover="this.style.background='#6a143a'"
                        onmouseout="this.style.background='#89194b'">

                        Buscar

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

                        <input type="tel" wire:model="telefono" placeholder="10 dígitos" maxlength="10"
                            class="w-full px-4 py-3 text-base rounded-lg border outline-none"
                            style="border-color:#d1d5db;" />

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

    </div>

</div>