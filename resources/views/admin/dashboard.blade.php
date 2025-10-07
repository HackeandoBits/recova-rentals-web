@extends('layouts.app')

@section('content')
  <section class="container mx-auto px-4 py-8 space-y-6">
    <h1 class="text-2xl font-bold">Panel</h1>
    <div class="grid md:grid-cols-3 gap-4">
      <a href="{{ route('bookings.create') }}" class="rounded-2xl border p-4 hover:shadow">Nueva reserva</a>
      <a href="{{ route('owner.blocks') }}" class="rounded-2xl border p-4 hover:shadow">Bloqueos del calendario</a>
      <a href="{{ route('catalog') }}" class="rounded-2xl border p-4 hover:shadow">Ver catálogo</a>
    </div>
  </section>
@endsection

<x-layout title="Dashboard">
  <section class="max-w-6xl mx-auto p-4 space-y-4">
    <h1 class="text-2xl font-bold">Panel</h1>
    <div class="grid md:grid-cols-3 gap-4">
      <a href="{{ route('bookings.create') }}" class="border rounded-2xl p-4">Nueva reserva</a>
      <a href="{{ route('owner.blocks') }}" class="border rounded-2xl p-4">Bloqueos del calendario</a>
      <a href="{{ route('catalog') }}" class="border rounded-2xl p-4">Catálogo</a>
    </div>
  </section>
</x-layout>
