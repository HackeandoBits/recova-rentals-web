<section id="inicio" class="relative min-h-screen flex items-center justify-center overflow-hidden">
  {{-- Background Image with Overlay --}}
  <div
    class="absolute inset-0 bg-cover bg-center bg-no-repeat z-[-1]"
    style="background-image: url('{{ asset('images/ui/hero-image.jpg') }}')"
  >
    <div class="absolute inset-0 bg-gradient-to-r from-background/90 via-background/70 to-background/90"></div>
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
          {{-- Star icon --}}
          <svg class="h-8 w-8 text-accent mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.75.75 0 0 1 1.04 0l2.36 2.36a.75.75 0 0 0 .424.21l3.332.484a.75.75 0 0 1 .416 1.279l-2.41 2.35a.75.75 0 0 0-.216.663l.569 3.316a.75.75 0 0 1-1.088.79l-2.978-1.565a.75.75 0 0 0-.698 0L8.24 15.25a.75.75 0 0 1-1.088-.79l.569-3.316a.75.75 0 0 0-.216-.663L5.095 7.832a.75.75 0 0 1 .416-1.28l3.333-.484a.75.75 0 0 0 .424-.21l2.212-2.359Z"/>
          </svg>
          <div class="text-2xl font-bold text-primary">500+</div>
          <div class="text-sm text-muted-foreground">Eventos Realizados</div>
        </div>

        <div class="text-center space-y-2">
          {{-- Users icon --}}
          <svg class="h-8 w-8 text-neon-blue mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 14a4 4 0 1 1 4 4M12 14a4 4 0 1 1 4 4M8 14a4 4 0 1 1 4 4M6 10a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z"/>
          </svg>
          <div class="text-2xl font-bold text-primary">50K+</div>
          <div class="text-sm text-muted-foreground">Personas Impactadas</div>
        </div>

        <div class="text-center space-y-2">
          {{-- Award icon --}}
          <svg class="h-8 w-8 text-neon-purple mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17v4l-3-2-3 2v-4m11-9a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"/>
          </svg>
          <div class="text-2xl font-bold text-primary">5</div>
          <div class="text-sm text-muted-foreground">Años de Experiencia</div>
        </div>

        <div class="text-center space-y-2">
          {{-- Play icon --}}
          <svg class="h-8 w-8 text-neon-pink mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="m5 3 14 9-14 9V3Z"/>
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
