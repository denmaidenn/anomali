@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Tambah Produk Baru</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Tambah Data Produk</h5>

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

                    <!-- Form untuk menambah produk baru -->
                    <form action="{{ route('fishmart.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan nama produk" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_produk">Deskripsi Produk</label>
                            <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="4" placeholder="Masukkan deskripsi produk"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="gambar_produk">Gambar Produk</label>
                            <input type="file" class="form-control-file" id="gambar_produk" name="gambar_produk">
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok Produk</label>
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan jumlah stok" required>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga Produk</label>
                            <input type="number" step="0.01" class="form-control" id="harga" name="harga" placeholder="Masukkan harga produk" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('fishmart.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
