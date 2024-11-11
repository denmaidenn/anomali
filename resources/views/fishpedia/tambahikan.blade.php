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
                    <form method="POST" action="{{ route('fishpedia.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Ilmiah -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input name="nama" type="text" class="form-control" id="nama" placeholder="Masukkan Nama" required>
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Nama Ilmiah -->
                        <div class="form-group">
                            <label for="nama_ilmiah">Nama Ilmiah</label>
                            <input name="nama_ilmiah" type="text" class="form-control" id="nama_ilmiah" placeholder="Masukkan Nama ilmiah" required>
                            @error('nama_ilmiah') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" class="form-control" id="kategori" placeholder="Pilih Kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Ikan Hias Air Tawar">Ikan Hias Air Tawar</option>
                                <option value="Ikan Hias Air Laut">Ikan Hias Air Laut</option>
                                <option value="Koi" >Koi</option>
                                <option value="Cupang" >Cupang</option>
                                <option value="Gabus" >Gabus</option>
                            </select>
                            @error('kategori') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Asal -->
                        <div class="form-group">
                            <label for="asal">Asal</label>
                            <input name="asal" type="text" class="form-control" id="asal" placeholder="Masukkan Asal" required>
                            @error('asal') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Ukuran -->
                        <div class="form-group">
                            <label for="ukuran">Ukuran</label>
                            <input name="ukuran" type="text" class="form-control" id="ukuran" placeholder="Masukkan Ukuran" required>
                            @error('ukuran') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Karakteristik -->
                        <div class="form-group">
                            <label for="karakteristik">Karakteristik</label>
                            <textarea name="karakteristik" class="form-control" id="karakteristik" placeholder="Masukkan Karakteristik"></textarea>
                            @error('karakteristik') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Akuarium -->
                        <div class="form-group">
                            <label for="akuarium">Akuarium</label>
                            <input name="akuarium" type="text" class="form-control" id="akuarium" placeholder="Masukkan Akuarium" required>
                            @error('akuarium') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Suhu Ideal -->
                        <div class="form-group">
                            <label for="suhu_ideal">Suhu Ideal</label>
                            <input name="suhu_ideal" type="number" class="form-control" id="suhu_ideal" placeholder="Masukkan Suhu Ideal" required>
                            @error('suhu_ideal') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- pH Air -->
                        <div class="form-group">
                            <label for="ph_air">pH Air</label>
                            <input name="ph_air" type="number" step="0.1" class="form-control" id="ph_air" placeholder="Masukkan pH Air"  required>
                            @error('ph_air') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Salinitas -->
                        <div class="form-group">
                            <label for="salinitas">Salinitas</label>
                            <input name="salinitas" type="text"  class="form-control" id="salinitas" placeholder="Masukkan Salinitas" required>
                            @error('salinitas') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Pencahayaan -->
                        <div class="form-group">
                            <label for="pencahayaan">Pencahayaan</label>
                            <input name="pencahayaan" type="text" class="form-control" id="pencahayaan" placeholder="Masukkan Pencahayaan" required>
                            @error('pencahayaan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Gambar Ikan -->
                        <div class="form-group">
                            <label for="gambar_ikan">Gambar Ikan</label>
                            <input name="gambar_ikan" type="file" class="form-control" id="gambar_ikan" accept="image/*">
                            @error('gambar_ikan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <!-- Area untuk menampilkan notifikasi setelah AJAX submit -->
                    <div id="ajax-notification" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
