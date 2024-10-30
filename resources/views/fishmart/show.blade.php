@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Detail Produk</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">{{ $produk->nama_produk }}</h5>

                    <div class="mb-3">
                        <strong>Deskripsi:</strong>
                        <p>{{ $produk->deskripsi_produk ?? 'Tidak ada deskripsi.' }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Stok:</strong>
                        <p>{{ $produk->stok }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Harga:</strong>
                        <p>Rp {{ number_format($produk->harga, 2) }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Gambar Produk:</strong><br>
                        @if($produk->gambar_produk)
                            <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="Gambar Produk" width="200">
                        @else
                            <p>Tidak ada gambar.</p>
                        @endif
                    </div>

                    <a href="{{ route('fishmart.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    <a href="{{ route('fishmart.edit', $produk->id) }}" class="btn btn-primary mt-3">Edit Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
