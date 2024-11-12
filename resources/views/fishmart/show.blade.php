@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail Produk</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Informasi Produk</h5>

                    <!-- Notifikasi sukses dan error -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Detail Produk -->
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Nama Produk:</div>
                        <div class="col-md-8">{{ $produk->nama_produk }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Deskripsi:</div>
                        <div class="col-md-8">{{ $produk->deskripsi_produk ?? 'Tidak ada deskripsi.' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Kategori:</div>
                        <div class="col-md-8">{{ $produk->kategori ?? 'Tidak ada kategori.' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Stok:</div>
                        <div class="col-md-8">{{ $produk->stok }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Harga:</div>
                        <div class="col-md-8">Rp {{ number_format($produk->harga, 2) }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Gambar Produk:</div>
                        <div class="col-md-8">
                            @if($produk->gambar_produk)
                                <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="Gambar Produk" class="img-fluid rounded shadow-sm" width="200">
                            @else
                                <p class="text-muted">Tidak ada gambar.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
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
