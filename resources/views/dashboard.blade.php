@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Dashboard</h3>

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

    <!-- Tabel User -->
    @include('layout.user')

    <!-- Tabel Fishpedia -->
    @include('layout.fishpedia')

    <!-- Tabel Pelatihan -->
    @include('layout.pelatihan')

    <!-- Table Pelatih -->
    @include('layout.pelatih')

    <!-- Tabel Fishmart -->
    @include('layout.fishmart')

    <!-- Tabel Feedback -->
    @include('layout.feedback')
</div>
@endsection


