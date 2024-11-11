@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail Produk</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $produk->nama_produk }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Deskripsi:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $produk->deskripsi_produk ?? 'Tidak ada deskripsi.' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Stok:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $produk->stok }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Harga:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>Rp {{ number_format($produk->harga, 2) }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Gambar Produk:</strong>
                        </div>
                        <div class="col-md-8">
                            @if($produk->gambar_produk)
                                <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="Gambar Produk" class="img-fluid rounded shadow-sm" width="200">
                            @else
                                <p class="text-muted">Tidak ada gambar.</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('fishmart.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <a href="{{ route('fishmart.edit', $produk->id) }}" class="btn btn-primary">Edit Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
