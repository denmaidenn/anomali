@extends('layout.main')

@section('content')
<div class="container mt-5">
    <a href="#" class="btn btn-secondary mb-4">← Kembali</a>

    <div class="text-center">
        <img src="{{ asset('images/koi_slayer.jpg') }}" class="img-fluid" alt="Koi Slayer" style="max-width: 400px;">
        <h2>{{ $fish->name }}</h2>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h4>Informasi Umum</h4>
            <p><strong>Nama Ilmiah:</strong> {{ $fish->scientific_name }}</p>
            <p><strong>Kategori:</strong> {{ $fish->category }}</p>

            <h4>Deskripsi Ikan</h4>
            <p><strong>Asal:</strong> {{ $fish->origin }}</p>
            <p><strong>Ukuran:</strong> {{ $fish->size }}</p>
            <p><strong>Karakteristik:</strong> {{ $fish->characteristics }}</p>

            <h4>Perawatan</h4>
            <p><strong>Akuarium:</strong> {{ $fish->aquarium_size }}L air</p>
            <p><strong>Suhu Ideal:</strong> {{ $fish->temperature }}°C</p>
            <p><strong>pH Air:</strong> {{ $fish->ph }}</p>
            <p><strong>Salinitas:</strong> {{ $fish->salinity }}</p>
            <p><strong>Pencahayaan:</strong> {{ $fish->lighting }}</p>
        </div>
    </div>
</div>
@endsection
