@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Edit Produk Fishmart</h3>

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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('fishmart.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi_produk">Deskripsi</label>
                    <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control" required>{{ $produk->deskripsi_produk }}</textarea>
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="{{ $produk->kategori }}" required>
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" value="{{ $produk->stok }}" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="{{ $produk->harga }}" required>
                </div>

                <div class="form-group">
                    <label for="gambar_produk">Gambar Produk</label>
                    <input type="file" name="gambar_produk" id="gambar_produk" class="form-control">
                    @if($produk->gambar_produk)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="Gambar Produk" width="100px" height="auto">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('fishmart.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
