@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Tambah Pelatihan</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Tambah Data Pelatihan</h5>

                    <!-- Success and error notifications -->
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

                    <form method="POST" action="{{ route('pelatihan.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Pelatih Dropdown -->
                        <div class="form-group">
                            <label for="id_user">Pelatih</label>
                            <select class="form-control" id="id_user" name="id_user" required>
                                <option value="" disabled selected>Pilih Pelatih</option>
                                @foreach($pelatih as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_user') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Judul Pelatihan -->
                        <div class="form-group">
                            <label for="judul">Judul Pelatihan</label>
                            <input name="judul" type="text" class="form-control" id="judul" placeholder="Masukkan judul pelatihan" required>
                            @error('judul') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Video Pelatihan -->
                        <div class="form-group">
                            <label for="video_pelatihan">Video Pelatihan</label>
                            <input name="video_pelatihan" type="file" class="form-control" id="video_pelatihan" required>
                            @error('video_pelatihan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Gambar Pelatihan -->
                        <div class="form-group">
                            <label for="gambar_pelatihan">Gambar Pelatihan (Optional)</label>
                            <input name="gambar_pelatihan" type="file" class="form-control" id="gambar_pelatihan">
                            @error('gambar_pelatihan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Deskripsi Pelatihan -->
                        <div class="form-group">
                            <label for="deskripsi_pelatihan">Deskripsi Pelatihan</label>
                            <textarea name="deskripsi_pelatihan" class="form-control" id="deskripsi_pelatihan" rows="4" placeholder="Masukkan deskripsi pelatihan" required></textarea>
                            @error('deskripsi_pelatihan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Harga Pelatihan -->
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input name="harga" type="number" class="form-control" id="harga" placeholder="Masukkan harga pelatihan" required>
                            @error('harga') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah Pelatihan</button>
                        <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
