<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">
            <!-- Encabezado con color Azul Institucional -->
            <div class="bg-[#ee7a00] p-8 text-center">
                <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-black text-white uppercase tracking-tight">¡Registro Completado!</h2>
            </div>

            <div class="p-8 text-center">
                <!-- Imprimimos el nombre desde la sesión -->
                <p class="text-xl mb-2">
                    <strong>{{ session('nombre') }}</strong>
                </p>
                <p class="text-gray-600 font-medium">
                    Tu participación ha sido registrada correctamente. Este es tu
                    número de folio:
                </p>

                <!-- Recuadro del Folio - Color Negro/Gris Oscuro -->
                <div class="mt-6 p-6 bg-[#111827] rounded-2xl border-4 border-dashed border-gray-400">
                    <span class="text-4xl font-mono font-black text-white tracking-widest">
                        {{ session('folio') }}
                    </span>
                </div>

                <div class="mt-8 space-y-4">
                    <p class="text-xs text-gray-400 uppercase font-bold">Importante</p>
                    <p class="text-sm text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        Toma una <strong>captura de pantalla</strong> o <strong>imprime</strong> esta página. Deberás
                        presentar este folio para reclamar tu premio en caso de resultar ganador.
                    </p>

                    <button onclick="window.print()"
                        class="w-full py-3 px-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                            </path>
                        </svg>
                        IMPRIMIR COMPROBANTE
                    </button>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('registro-rifa') }}"
                    class="w-full sm:w-auto px-5 py-3 text-base font-medium text-white rounded-lg transition inline-block text-center no-underline"
                    style="background:#89194b;" 
                    onmouseover="this.style.background='#6a143a'"
                    onmouseout="this.style.background='#89194b'">
                        Regresar al Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>