<section id="inicio" class="relative min-h-screen flex items-center justify-center overflow-hidden">
  {{-- Imagen de fondo --}}
  <div
    class="absolute inset-0 bg-cover bg-center bg-no-repeat -z-10"
    style="background-image: url('{{ asset('images/ui/hero-image.jpg') }}');"
  >
    {{-- Filtro oscuro/gradiente --}}
    <div class="absolute inset-0 bg-gradient-to-r from-[hsl(298,42%,15%)/90] via-[hsl(298,42%,15%)/70] to-[hsl(298,42%,15%)/90]"></div>
  </div>


  {{-- Content --}}
  <div class="relative z-10 container mx-auto px-4 py-20">
    <div class="text-center space-y-8 animate-fade-in">
      {{-- Main Title --}}
      <div class="space-y-4">
        <h1 class="text-5xl md:text-7xl font-bold bg-gradient-hero bg-clip-text text-transparent animate-glow-pulse">
          RECOVA RENTALS
        </h1>
        <p class="text-xl md:text-2xl text-accent font-semibold">
          Equipos Profesionales para Eventos
        </p>
      </div>

      {{-- Description --}}
      <div class="max-w-3xl mx-auto space-y-6">
        <p class="text-lg md:text-xl text-foreground/90 leading-relaxed">
          Transformamos tus eventos con la tecnología más avanzada en
          <span class="text-neon-blue font-semibold">pantallas LED</span>,
          <span class="text-neon-purple font-semibold">iluminación profesional</span>,
          <span class="text-neon-pink font-semibold">sistemas láser</span>,
          <span class="text-electric-cyan font-semibold">sonido de alta calidad</span>
          y <span class="text-accent font-semibold">escenarios modulares</span>.
        </p>

        <p class="text-md text-muted-foreground">
          Desde conciertos hasta eventos corporativos, tenemos todo lo que necesitas
          para crear experiencias inolvidables.
        </p>
      </div>

      {{-- Stats --}}
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-2xl mx-auto">
        <div class="text-center space-y-2">
          {{-- Star icon (Lucide) --}}
          <svg class="h-8 w-8 text-accent mx-auto" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
               aria-hidden="true">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14
                             18.18 21.02 12 17.77 5.82 21.02
                             7 14.14 2 9.27 8.91 8.26 12 2"/>
          </svg>
          <div class="text-2xl font-bold text-primary">500+</div>
          <div class="text-sm text-muted-foreground">Eventos Realizados</div>
        </div>

        <div class="text-center space-y-2">
          {{-- Users icon (Lucide) --}}
          <svg class="h-8 w-8 text-neon-blue mx-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
          <div class="text-2xl font-bold text-primary">50K+</div>
          <div class="text-sm text-muted-foreground">Personas Impactadas</div>
        </div>

        <div class="text-center space-y-2">
          {{-- Award icon (Lucide) --}}
          <svg class="h-8 w-8 text-neon-purple mx-auto" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
               aria-hidden="true">
            <circle cx="12" cy="8" r="7" />
            <path d="M8.21 13.89 7 23l5-3 5 3-1.21-9.12" />
          </svg>
          <div class="text-2xl font-bold text-primary">5</div>
          <div class="text-sm text-muted-foreground">Años de Experiencia</div>
        </div>

        <div class="text-center space-y-2">
          {{-- Play icon (solid) --}}
          <svg class="h-8 w-8 text-neon-pink mx-auto" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <polygon points="5,3 19,12 5,21" />
          </svg>
          <div class="text-2xl font-bold text-primary">24/7</div>
          <div class="text-sm text-muted-foreground">Soporte Técnico</div>
        </div>
      </div>

      {{-- CTA Buttons --}}
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="{{ route('catalog') }}">
          <span class="inline-flex items-center justify-center bg-gradient-accent hover:scale-105 transition-all duration-300 glow-accent text-lg px-8 py-3 rounded-md">
            Ver Nuestros Equipos
          </span>
        </a>
        <a href="{{ route('gallery') }}">
          <span class="inline-flex items-center justify-center border border-primary text-primary hover:bg-primary hover:text-primary-foreground text-lg px-8 py-3 transition-all duration-300 rounded-md">
            Ver Galería de Eventos
          </span>
        </a>
      </div>
    </div>
  </div>

  {{-- Animated Elements --}}
  <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
    <div class="w-6 h-10 border-2 border-primary rounded-full flex justify-center">
      <div class="w-1 h-3 bg-primary rounded-full mt-2 animate-pulse"></div>
    </div>
  </div>
</section>
