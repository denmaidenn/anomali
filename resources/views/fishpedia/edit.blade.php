@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Edit Fish Data</h3>

    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('fishpedia.update', $fish->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Menampilkan pesan kesalahan jika ada -->
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Nama -->
                        <div class="form-group">
                            <label for="nama">Nama Ikan</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $fish->nama) }}" required>
                        </div>

                        <!-- Asal -->
                        <div class="form-group">
                            <label for="asal">Asal</label>
                            <input type="text" name="asal" class="form-control" value="{{ old('asal', $fish->asal) }}" required>
                        </div>

                        <!-- Jenis -->
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <input type="text" name="jenis" class="form-control" value="{{ old('jenis', $fish->jenis) }}" required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $fish->deskripsi) }}</textarea>
                        </div>

                        <!-- Harga Pasar -->
                        <div class="form-group">
                            <label for="harga_pasar">Harga Pasar</label>
                            <input type="text" name="harga_pasar" class="form-control" value="{{ old('harga_pasar', $fish->harga_pasar) }}" required>
                        </div>

                        <!-- Gambar Ikan -->
                        <div class="form-group">
                            <label for="gambar_ikan">Gambar Ikan</label>
                            <input type="file" name="gambar_ikan" class="form-control-file">
                            @if($fish->gambar_ikan)
                                <small>Current image: {{ $fish->gambar_ikan }}</small>
                            @endif
                        </div>

                        <!-- Tombol Submit -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Fish Data</button>
                            <a href="{{ route('fishpedia.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
