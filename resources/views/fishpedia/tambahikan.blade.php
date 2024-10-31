@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Tambah Ikan Baru</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Tambah Data Ikan</h5>

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

                    <!-- Form untuk menambah ikan baru -->
                    <form id="fish-form" action="{{ route('fishpedia.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama Ikan</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="scientific_name">Nama Ilmiah</label>
                            <input type="text" class="form-control" id="scientific_name" name="scientific_name" placeholder="Masukkan nama ilmiah ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" class="form-control" id="category" name="category" placeholder="Masukkan kategori ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="origin">Asal</label>
                            <input type="text" class="form-control" id="origin" name="origin" placeholder="Masukkan asal ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="size">Ukuran</label>
                            <input type="text" class="form-control" id="size" name="size" placeholder="Masukkan ukuran ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="characteristics">Karakteristik</label>
                            <textarea class="form-control" id="characteristics" name="characteristics" rows="4" placeholder="Masukkan karakteristik ikan" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="aquarium_size">Akuarium</label>
                            <input type="text" class="form-control" id="aquarium_size" name="aquarium_size" placeholder="Masukkan ukuran akuarium" required>
                        </div>

                        <div class="form-group">
                            <label for="temperature">Suhu Ideal</label>
                            <input type="text" class="form-control" id="temperature" name="temperature" placeholder="Masukkan suhu ideal" required>
                        </div>

                        <div class="form-group">
                            <label for="ph">pH Air</label>
                            <input type="text" class="form-control" id="ph" name="ph" placeholder="Masukkan pH air" required>
                        </div>

                        <div class="form-group">
                            <label for="salinity">Salinitas</label>
                            <input type="text" class="form-control" id="salinity" name="salinity" placeholder="Masukkan salinitas" required>
                        </div>

                        <div class="form-group">
                            <label for="lighting">Pencahayaan</label>
                            <input type="text" class="form-control" id="lighting" name="lighting" placeholder="Masukkan pencahayaan" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/fishpedia" class="btn btn-secondary">Kembali</a>
                    </form>
                    <!-- Area untuk menampilkan notifikasi setelah AJAX submit -->
                    <div id="ajax-notification" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
