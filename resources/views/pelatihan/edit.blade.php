@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Edit Pelatihan</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Edit Data Pelatihan</h5>
                    <form class="forms-sample" method="POST" action="{{ route('pelatihan.update', $pelatihan->id) }}">
                        @csrf
                        @method('PUT') <!-- Menggunakan PUT untuk update data -->

                        <!-- Dropdown untuk memilih User -->
                        <div class="form-group">
                            <label for="id_user">User</label>
                            <select class="form-control" id="id_user" name="id_user" required>
                                <option value="" disabled>Pilih User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $pelatihan->id_user == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_user')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="video_pelatihan">Video Pelatihan</label>
                            <input name="video_pelatihan" type="text" class="form-control" id="video_pelatihan" placeholder="Masukkan URL video pelatihan" value="{{ old('video_pelatihan', $pelatihan->video_pelatihan) }}" required>
                            @error('video_pelatihan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_pelatihan">Deskripsi Pelatihan</label>
                            <textarea name="deskripsi_pelatihan" class="form-control" id="deskripsi_pelatihan" rows="4" placeholder="Masukkan Deskripsi pelatihan" required>{{ old('deskripsi_pelatihan', $pelatihan->deskripsi_pelatihan) }}</textarea>
                            @error('deskripsi_pelatihan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input name="harga" type="number" class="form-control" id="harga" placeholder="Masukkan harga pelatihan" value="{{ old('harga', $pelatihan->harga) }}" required>
                            @error('harga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
