@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail Pelatih</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Data Pelatih: {{ $pelatih->nama }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Nama:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $pelatih->nama }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $pelatih->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>No. Telepon:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $pelatih->no_telp }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Alamat:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $pelatih->alamat }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('pelatih.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <a href="{{ route('pelatih.edit', $pelatih->id) }}" class="btn btn-primary">Edit Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
