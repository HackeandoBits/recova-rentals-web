{{-- Gallery: TopBanner + Header + GallerySection + Footer --}}
@extends('layouts.app')

@section('content')
  <main style="padding-top: 140px">
    {{-- GallerySection --}}
    @include('sections.gallery-section')
  </main>
@endsection
