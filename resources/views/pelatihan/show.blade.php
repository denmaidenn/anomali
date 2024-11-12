@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail Pelatihan</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $pelatihan->deskripsi_pelatihan }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>User:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $pelatihan->user->name ?? 'User Tidak Ditemukan' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Deskripsi Pelatihan:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $pelatihan->deskripsi_pelatihan ?? 'Tidak ada deskripsi.' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Video Pelatihan:</strong>
                        </div>
                        <div class="col-md-8">
                            <a href="{{ $pelatihan->video_pelatihan }}" target="_blank">{{ $pelatihan->video_pelatihan }}</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Harga:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>Rp {{ number_format($pelatihan->harga, 2) }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <a href="{{ route('pelatihan.edit', $pelatihan->id) }}" class="btn btn-primary">Edit Pelatihan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
