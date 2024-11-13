@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Edit Pelatihan</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Edit Data Pelatihan</h5>

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

                    <form class="forms-sample" method="POST" action="{{ route('pelatihan.update', $pelatihan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Dropdown untuk memilih Pelatih -->
                        <div class="form-group">
                            <label for="id_user">Pelatih</label>
                            <select class="form-control" id="id_user" name="id_user" required>
                                <option value="" disabled>Pilih Pelatih</option>
                                @foreach($pelatih as $item)
                                    <option value="{{ $item->id }}" {{ $pelatihan->id_user == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_user')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Judul Pelatihan -->
                        <div class="form-group">
                            <label for="judul">Judul Pelatihan</label>
                            <input name="judul" type="text" class="form-control" id="judul" placeholder="Masukkan judul pelatihan" value="{{ old('judul', $pelatihan->judul) }}" required>
                            @error('judul')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Video Pelatihan -->
                        <div class="form-group">
                            <label for="video_pelatihan">Video Pelatihan</label>
                            <input name="video_pelatihan" type="file" class="form-control" id="video_pelatihan">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah video.</small>
                            @if($pelatihan->video_pelatihan)
                                <p><strong>Video Saat Ini:</strong> <a href="{{ asset('storage/' . $pelatihan->video_pelatihan) }}" target="_blank">Lihat Video</a></p>
                            @endif
                            @error('video_pelatihan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gambar Pelatihan -->
                        <div class="form-group">
                            <label for="gambar_pelatihan">Gambar Pelatihan (Optional)</label>
                            <input name="gambar_pelatihan" type="file" class="form-control" id="gambar_pelatihan">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                            @if($pelatihan->gambar_pelatihan)
                                <p><strong>Gambar Saat Ini:</strong></p>
                                <img src="{{ asset('storage/' . $pelatihan->gambar_pelatihan) }}" alt="Gambar Pelatihan" style="width: 100px; height: auto;">
                            @endif
                            @error('gambar_pelatihan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi Pelatihan -->
                        <div class="form-group">
                            <label for="deskripsi_pelatihan">Deskripsi Pelatihan</label>
                            <textarea name="deskripsi_pelatihan" class="form-control" id="deskripsi_pelatihan" rows="4" placeholder="Masukkan deskripsi pelatihan" required>{{ old('deskripsi_pelatihan', $pelatihan->deskripsi_pelatihan) }}</textarea>
                            @error('deskripsi_pelatihan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
