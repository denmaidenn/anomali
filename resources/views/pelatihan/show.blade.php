@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Detail Pelatihan</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $pelatihan->judul }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Pelatih:</strong></div>
                        <div class="col-md-8">{{ $pelatihan->user->nama ?? 'Pelatih Tidak Ditemukan' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Deskripsi Pelatihan:</strong></div>
                        <div class="col-md-8">{{ $pelatihan->deskripsi_pelatihan ?? 'Tidak ada deskripsi.' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Video Pelatihan:</strong></div>
                        <div class="col-md-8">
                            @if($pelatihan->video_pelatihan)
                                <video width="320" height="240" controls>
                                    <source src="{{ asset('storage/' . $pelatihan->video_pelatihan) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <span>No Video Available</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Gambar Pelatihan:</strong></div>
                        <div class="col-md-8">
                            @if($pelatihan->gambar_pelatihan)
                                <img src="{{ asset('storage/' . $pelatihan->gambar_pelatihan) }}" alt="Gambar Pelatihan" style="width: 100px; height: auto;">
                            @else
                                <span>No Image Available</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Harga:</strong></div>
                        <div class="col-md-8">Rp {{ number_format($pelatihan->harga, 2) }}</div>
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
