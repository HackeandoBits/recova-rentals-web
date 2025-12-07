<footer class="bg-gray-900 border-t border-purple-500/30 relative overflow-hidden">
    {{-- Efecto de brillo de fondo --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-1 bg-gradient-to-r from-transparent via-purple-500 to-transparent opacity-50"></div>
    
    <div class="container mx-auto px-4 py-16 relative z-10">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
            {{-- 1. Marca y Misión --}}
            <div class="space-y-6">
                <div>
                    <h3 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600 mb-4 inline-block">
                        RECOVA RENTALS
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Elevando el estándar de tus eventos con tecnología audiovisual de vanguardia. 
                        Creamos atmósferas inolvidables mediante iluminación, sonido y visuales de alto impacto.
                    </p>
                </div>

                {{-- Redes Sociales Estilizadas --}}
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-400 hover:text-white hover:border-purple-500 hover:bg-purple-500/10 transition-all duration-300 group">
                        <i class="fab fa-instagram text-lg group-hover:scale-110 transition-transform"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-400 hover:text-white hover:border-blue-500 hover:bg-blue-500/10 transition-all duration-300 group">
                        <i class="fab fa-facebook-f text-lg group-hover:scale-110 transition-transform"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-400 hover:text-white hover:border-red-500 hover:bg-red-500/10 transition-all duration-300 group">
                        <i class="fab fa-youtube text-lg group-hover:scale-110 transition-transform"></i>
                    </a>
                </div>
            </div>

            {{-- 2. Navegación --}}
            <div class="space-y-6">
                <h4 class="text-lg font-semibold text-white border-b border-gray-800 pb-2 inline-block">Explorar</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="group flex items-center text-gray-400 hover:text-purple-400 transition-colors text-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-600 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('catalog') }}" class="group flex items-center text-gray-400 hover:text-purple-400 transition-colors text-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-600 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            Catálogo y Productos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery') }}" class="group flex items-center text-gray-400 hover:text-purple-400 transition-colors text-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-600 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            Galería de Eventos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('location') }}" class="group flex items-center text-gray-400 hover:text-purple-400 transition-colors text-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-600 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            Ubicación
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="group flex items-center text-gray-400 hover:text-purple-400 transition-colors text-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-600 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            Sobre Nosotros
                        </a>
                    </li>
                </ul>
            </div>

            {{-- 3. Servicios Destacados --}}
            <div class="space-y-6">
                <h4 class="text-lg font-semibold text-white border-b border-gray-800 pb-2 inline-block">Servicios</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start">
                        <i class="fas fa-check text-purple-500 mt-1 mr-2 text-xs"></i>
                        <span>Pantallas LED Indoor/Outdoor</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-purple-500 mt-1 mr-2 text-xs"></i>
                        <span>Iluminación Robótica & Láser</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-purple-500 mt-1 mr-2 text-xs"></i>
                        <span>Sistema de Sonido Line Array</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-purple-500 mt-1 mr-2 text-xs"></i>
                        <span>Escenarios & Estructuras Truss</span>
                    </li>
                </ul>
            </div>

            {{-- 4. Contacto y Horarios --}}
            <div class="space-y-6">
                <h4 class="text-lg font-semibold text-white border-b border-gray-800 pb-2 inline-block">Contacto</h4>
                
                <div class="space-y-4">
                    {{-- Botón WhatsApp Destacado --}}
                    <a href="https://wa.me/543704567890" target="_blank" 
                       class="block w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-500 hover:to-green-400 text-white text-center py-3 rounded-xl font-bold shadow-lg shadow-green-900/20 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fab fa-whatsapp text-xl"></i>
                        <span>Hablemos por WhatsApp</span>
                    </a>

                    <div class="bg-gray-800/50 rounded-xl p-4 border border-gray-700 space-y-3">
                         <div class="flex items-start gap-3">
                            <div class="mt-1 bg-purple-500/20 p-1.5 rounded-md text-purple-400">
                                <i class="far fa-clock text-xs"></i>
                            </div>
                            <div class="text-sm">
                                <p class="text-white font-medium">Horarios de Atención</p>
                                <p class="text-gray-400 text-xs mt-1">Lun - Vie: 9:00 - 18:00</p>
                                <p class="text-gray-400 text-xs">Sáb: 9:00 - 13:00</p>
                                <p class="text-purple-400 text-xs font-medium mt-1">Entregas 24/7 (Coordinadas)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="border-t border-gray-800 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-center md:text-left">
                <p class="text-gray-500 text-sm font-medium">© {{ date('Y') }} Recova Rentals. Todos los derechos reservados.</p>
                <p class="text-gray-600 text-xs mt-1">Formosa, Argentina</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-6 text-xs text-gray-500 font-medium">
                <a href="#" class="hover:text-purple-400 transition-colors">Términos y Condiciones</a>
                <a href="#" class="hover:text-purple-400 transition-colors">Política de Privacidad</a>
                <a href="#" class="hover:text-purple-400 transition-colors">Ayuda</a>
            </div>
        </div>
    </div>
</footer>
