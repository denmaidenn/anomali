@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Edit Produk</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Edit Produk</h5>
                    <form class="form-sample" method="POST" action="{{ route('fishmart.update', $produk->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Menggunakan PUT untuk update data -->

                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input name="nama_produk" type="text" class="form-control p-input" id="nama_produk" placeholder="Nama Produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                            @error('nama_produk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_produk">Deskripsi Produk</label>
                            <textarea name="deskripsi_produk" class="form-control p-input" id="deskripsi_produk" placeholder="Deskripsi Produk" rows="3">{{ old('deskripsi_produk', $produk->deskripsi_produk) }}</textarea>
                            @error('deskripsi_produk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input name="stok" type="number" class="form-control p-input" id="stok" placeholder="Jumlah Stok" value="{{ old('stok', $produk->stok) }}" required>
                            @error('stok')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input name="harga" type="number" step="0.01" class="form-control p-input" id="harga" placeholder="Harga Produk" value="{{ old('harga', $produk->harga) }}" required>
                            @error('harga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gambar_produk">Gambar Produk</label>
                            <input name="gambar_produk" type="file" class="form-control-file" id="gambar_produk">
                            <small class="form-text text-muted">Unggah gambar jika ingin mengganti gambar yang sudah ada.</small>
                            @if($produk->gambar_produk)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="Gambar Produk" width="100">
                                </div>
                            @endif
                            @error('gambar_produk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('fishmart.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
