@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Pelatihan</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Tambah Data Pelatihan</h5>

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

                    <!-- Form untuk menambah pelatihan baru -->
                    <form id="pelatihan-form" action="{{ route('pelatihan.store') }}" method="POST">
                        @csrf

                        <!-- Dropdown untuk memilih User ID -->
                        <div class="form-group">
                            <label for="id_user">User</label>
                            <select class="form-control" id="id_user" name="id_user" required>
                                <option value="" disabled selected>Pilih User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="video_pelatihan">Video Pelatihan</label>
                            <input type="text" class="form-control" id="video_pelatihan" name="video_pelatihan" placeholder="Masukkan URL video pelatihan" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Pelatihan</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi pelatihan" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga pelatihan" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
