@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Dashboard</h3>

    @if (session('success_login'))
      <div class="alert alert-success">
        {{ session('success_login') }}
      </div>
    @endif
    @if (session('error_login'))
      <div class="alert alert-danger">
      {{ session('error_login') }}
      </div>
    @endif


          <!-- User Data Table -->
          @include('layout.user')

          <!-- Fishpedia Table -->
          @include('layout.fishpedia')

          <!-- Pelatihan Table -->
          @include('layout.pelatihan')

          <!-- Fishmart Table -->
          @include('layout.fishmart')


</div>
@endsection

