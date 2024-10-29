@extends('layout.main')

@section('content')
<div class="container">
    <h1>Detail Pelatihan</h1>
    <p><strong>ID:</strong> {{ $pelatihan->id }}</p>
    <p><strong>Deskripsi:</strong> {{ $pelatihan->deskripsi_pelatihan }}</p>
    <p><strong>Harga:</strong> {{ $pelatihan->harga }}</p>
    <p><strong>Video:</strong> {{ $pelatihan->video_pelatihan }}</p>

    <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
