{{-- About: TopBanner + Header + AboutSection + Footer --}}
@extends('layouts.app')

@section('content')
  <main style="padding-top: 140px">
    {{-- AboutSection --}}
    @include('sections.about-section')
  </main>
@endsection
