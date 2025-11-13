<footer class="bg-gradient-to-b from-background to-secondary/30 border-t border-border">
    <div class="container mx-auto px-4 py-16">
        {{-- Contenido principal --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            {{-- Información de la empresa --}}
            <div class="space-y-6">
                <div>
                    <h3 class="text-2xl font-bold bg-gradient-hero bg-clip-text text-transparent mb-3">
                        RECOVA RENTALS
                    </h3>
                    <p class="text-muted-foreground text-sm leading-relaxed">
                        Especialistas en equipos audiovisuales para eventos. 
                        Transformamos cada celebración en una experiencia inolvidable 
                        con tecnología de vanguardia y servicio profesional.
                    </p>
                </div>

                {{-- Redes sociales --}}
                <div class="space-y-3">
                    <h4 class="font-semibold text-foreground">Síguenos</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="p-2 border rounded-md border-border hover:border-accent hover:text-accent transition">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="p-2 border rounded-md border-border hover:border-accent hover:text-accent transition">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="p-2 border rounded-md border-border hover:border-accent hover:text-accent transition">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Navegación rápida --}}
            <div class="space-y-6">
                <h4 class="font-semibold text-foreground">Navegación</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-muted-foreground hover:text-accent transition text-sm">Inicio</a></li>
                    <li><a href="{{ route('catalog') }}" class="text-muted-foreground hover:text-accent transition text-sm">Productos</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-muted-foreground hover:text-accent transition text-sm">Galería</a></li>
                    <li><a href="{{ route('location') }}" class="text-muted-foreground hover:text-accent transition text-sm">Ubicación</a></li>
                    <li><a href="{{ route('about') }}" class="text-muted-foreground hover:text-accent transition text-sm">Nosotros</a></li>
                </ul>
            </div>

            {{-- Servicios --}}
            <div class="space-y-6">
                <h4 class="font-semibold text-foreground">Nuestros Servicios</h4>
                <ul class="space-y-3 text-sm text-muted-foreground">
                    <li>Pantallas LED</li>
                    <li>Iluminación Profesional</li>
                    <li>Sistemas Láser</li>
                    <li>Equipos de Sonido</li>
                    <li>Escenarios Modulares</li>
                    <li>Shows Personalizados</li>
                </ul>
            </div>

            {{-- Contacto --}}
            <div >
            @include('sections.contact-section', ['style' => 'footer'])
                </div>

                {{-- Horarios --}}
                <div class="space-y-3">
                    <div class="flex items-center space-x-2">
                        <i class="far fa-clock text-accent"></i>
                        <h5 class="font-semibold text-foreground text-sm">Horarios</h5>
                    </div>
                    <div class="text-xs text-muted-foreground space-y-1">
                        <p>Lun - Vie: 9:00 - 18:00</p>
                        <p>Sábados: 9:00 - 14:00</p>
                        <p>Domingos: Cerrado</p>
                        <p class="text-accent">Entregas 24/7 coordinando</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Separador --}}
        <div class="border-t border-border mb-8"></div>

        {{-- Parte inferior --}}
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 text-sm text-muted-foreground">
            <div class="text-center md:text-left">
                <p>© {{ date('Y') }} Recova Rentals App. Todos los derechos reservados.</p>
                <p class="mt-1">Formosa, Argentina - Especialistas en Eventos Audiovisuales</p>
            </div>

            <div class="flex items-center space-x-6 text-xs">
                <a href="#" class="hover:text-accent transition">Términos de Servicio</a>
                <a href="#" class="hover:text-accent transition">Política de Privacidad</a>
                <a href="#" class="hover:text-accent transition">Política de Cancelación</a>
            </div>
        </div>

        {{-- Emergencias --}}
        <div class="mt-8 text-center">
            <div class="inline-flex items-center space-x-2 bg-gradient-card px-4 py-2 rounded-full border border-border">
                <i class="fab fa-whatsapp text-accent"></i>
                <span class="text-sm text-muted-foreground">Emergencias 24/7:</span>
                <a href="https://wa.me/543704567890" target="_blank" class="text-sm font-semibold text-accent hover:text-accent/80 transition">
                    WhatsApp +54 370 456-7890
                </a>
            </div>
        </div>
    </div>
</footer>
