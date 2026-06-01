<div class="w-full max-w-2xl mx-auto mt-5 mb-5 px-4 py-4 sm:px-6 rounded-xl overflow-hidden border border-gray-200 shadow-sm">

    {{-- HEADER (Fiel a tu diseño original) --}}
    <div class="px-4 py-6 text-center" style="background:#ee7a00;">
        <h2 class="text-3xl font-bold text-white mb-2 uppercase tracking-tight">
            Registro Rifa 2026
        </h2>
        <div class="inline-block px-4 py-1 rounded-full bg-white/20 text-white text-sm font-bold uppercase tracking-widest">
            Registro Finalizado
        </div>
    </div>

    {{-- BODY --}}
    <div class="bg-white px-5 sm:px-10 py-10">
        
        {{-- SECCIÓN DEL EVENTO (Datos de la imagen) --}}
        <div class="text-center mb-10">
            <h3 class="text-2xl font-extrabold mb-6" style="color: #89194b;">
                ¡Gracias por participar!
            </h3>
            
            {{-- CAJA DE INFORMACIÓN DEL SORTEO --}}
            <div class="relative p-6 rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 overflow-hidden">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Detalles del Sorteo</p>
                
 
<div class="grid grid-cols-1 sm:grid-cols-[40%_60%] gap-6 items-center">

    {{-- FECHA Y HORA --}}
    <div class="flex items-center justify-center sm:justify-start gap-4">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center bg-white shadow-sm" style="color: #ee7a00;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>

        <div class="text-left">
            <p class="text-2xl font-black text-gray-800 leading-none">
                3 JUNIO
            </p>
            <p class="text-lg font-bold" style="color: #ee7a00;">
                5:00 PM
            </p>
        </div>
    </div>

    {{-- ENLACE FACEBOOK --}}
    <div class="flex items-center justify-center sm:justify-start gap-4 border-t sm:border-t-0 sm:border-l border-gray-200 pt-6 sm:pt-0 sm:pl-6">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center bg-white shadow-sm text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
        </div>

        <div class="text-left">
            <p class="text-xs font-bold text-gray-500 uppercase leading-none mb-1">
                Transmisión en:
            </p>

            <a href="https://www.facebook.com/snte56informafanpage"
               target="_blank"
               class="text-sm font-bold text-blue-800 hover:underline break-all">
                fb.com/snte56informa
            </a>
        </div>
    </div>

</div>             



            </div>
        </div>

        {{-- LEYENDA DE CONSULTA --}}
        <div class="border-t border-gray-100 pt-8 text-center">
            <p class="text-sm text-gray-500 mb-6 italic">
                ¿Deseas verificar tus datos o recuperar tu número de folio?
            </p>
            
            {{-- BOTÓN DE CONSULTA (Con tu estilo Guinda) --}}
            <a href="{{ route('consulta') }}" 
               class="w-full py-4 text-base font-bold text-white rounded-xl transition flex items-center justify-center gap-3 shadow-lg shadow-guinda/20"
               style="background:#89194b;" 
               onmouseover="this.style.background='#6a143a'; this.style.transform='translateY(-1px)'"
               onmouseout="this.style.background='#89194b'; this.style.transform='translateY(0)'">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /><path d="M7 10l2 2l4 -4" />
                </svg>
                CONSULTAR MI FOLIO REGISTRADO
            </a>
        </div>

    </div>

</div>