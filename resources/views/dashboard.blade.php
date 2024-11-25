@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Dashboard</h3>

    @if (session('success_login'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success_login') }}',
            });
        </script>
    @endif
    @if (session('error_login'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error_login') }}',
            });
        </script>
    @endif

    <!-- Tabel User -->
    @include('layout.user')

    <!-- Tabel Fishpedia -->
    @include('layout.fishpedia')

    <!-- Tabel Pelatihan -->
    @include('layout.pelatihan')

    <!-- Tabel Pelatihan(Free) -->
    @include('layout.pelatihanfree')

    <!-- Table Pelatih -->
    @include('layout.pelatih')

    <!-- Tabel Fishmart -->
    @include('layout.fishmart')

    <!-- Tabel Feedback -->
    @include('layout.feedback')

    <!-- Tabel Cart -->
    @include('layout.cart')

    <!-- Tabel Checkout -->
    @include('layout.checkout')
    
    <!-- Tabel Checkout Pelatihan-->
    @include('layout.checkout_pelatihan')

</div>
@endsection


