@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail Fishpedia</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $fish->nama }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Nama Ilmiah:</div>
                        <div class="col-md-8">{{ $fish->nama_ilmiah ?? 'Tidak ada nama ilmiah.' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Kategori:</div>
                        <div class="col-md-8">{{ $fish->kategori ?? 'Tidak ada kategori.' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Asal:</div>
                        <div class="col-md-8">{{ $fish->asal ?? 'Tidak ada informasi asal.' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Ukuran:</div>
                        <div class="col-md-8">{{ $fish->ukuran ?? 'Ukuran tidak diketahui.' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Karakteristik:</div>
                        <div class="col-md-8">{{ $fish->karakteristik ?? 'Karakteristik tidak diketahui.' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Akuarium:</div>
                        <div class="col-md-8">{{ $fish->akuarium ?? 'Tidak ada informasi ukuran akuarium.' }} L</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Suhu Ideal:</div>
                        <div class="col-md-8">{{ $fish->suhu_ideal ?? 'Suhu ideal tidak diketahui.' }} °C</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">pH Air:</div>
                        <div class="col-md-8">{{ $fish->ph_air ?? 'Tidak ada informasi pH.' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Salinitas:</div>
                        <div class="col-md-8">{{ $fish->salinitas ?? 'Salinitas tidak diketahui.' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Pencahayaan:</div>
                        <div class="col-md-8">{{ $fish->pencahayaan ?? 'Pencahayaan tidak diketahui.' }}</div>
                    </div>
                    <!-- Gambar Ikan -->
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Gambar Ikan:</div>
                        <div class="col-md-8">
                            @if($fish->gambar_ikan)
                                <img src="{{ asset('storage/' . $fish->gambar_ikan) }}" alt="Gambar Ikan" class="img-fluid rounded shadow-sm" width="200">
                            @else
                                <p class="text-muted">Tidak ada gambar.</p>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('fishpedia.index') }}" class="btn btn-secondary me-2">Kembali ke Daftar Fishpedia</a>
                        <a href="{{ route('fishpedia.edit', $fish->id) }}" class="btn btn-primary">Edit Ikan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
