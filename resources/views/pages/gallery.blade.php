@extends('livewire.layout.app')

@section('content')
    <main style="padding-top: 65px">
        <div class="container mx-auto px-4 mb-8 text-center animate-fade-in-down">
            <h1
                class="text-3xl md:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-600 mb-4">
                Galería de Eventos
            </h1>
            <p class="text-lg md:text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Descubre cómo transformamos espacios con nuestra <span class="font-semibold text-purple-400">tecnología y
                    creatividad</span>.
            </p>
        </div>
        <livewire:pages.gallery-list />
    </main>
@endsection
