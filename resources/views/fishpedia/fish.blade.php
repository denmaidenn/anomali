@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Form Informasi Ikan Koi Slayer</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="/submitFishInfo" method="POST">
                        @csrf
                        <div class="mb-4">
                            <h5 class="card-title">Informasi Umum</h5>
                            <div class="form-group">
                                <label for="nama_ilmiah">Nama Ilmiah</label>
                                <input type="text" class="form-control" id="nama_ilmiah" name="nama_ilmiah" placeholder="Masukkan Nama Ilmiah">
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan Kategori">
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="card-title">Deskripsi Ikan</h5>
                            <div class="form-group">
                                <label for="asal">Asal</label>
                                <input type="text" class="form-control" id="asal" name="asal" placeholder="Masukkan Asal Ikan">
                            </div>
                            <div class="form-group">
                                <label for="ukuran">Ukuran</label>
                                <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="Masukkan Ukuran (cm)">
                            </div>
                            <div class="form-group">
                                <label for="karakteristik">Karakteristik</label>
                                <input type="text" class="form-control" id="karakteristik" name="karakteristik" placeholder="Masukkan Karakteristik">
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="card-title">Perawatan</h5>
                            <div class="form-group">
                                <label for="akuarium">Akuarium</label>
                                <input type="text" class="form-control" id="akuarium" name="akuarium" placeholder="Masukkan Volume Akuarium (L)">
                            </div>
                            <div class="form-group">
                                <label for="suhu">Suhu Ideal</label>
                                <input type="text" class="form-control" id="suhu" name="suhu" placeholder="Masukkan Suhu Ideal (°C)">
                            </div>
                            <div class="form-group">
                                <label for="ph">pH Air</label>
                                <input type="text" class="form-control" id="ph" name="ph" placeholder="Masukkan pH Air">
                            </div>
                            <div class="form-group">
                                <label for="salinitas">Salinitas</label>
                                <input type="text" class="form-control" id="salinitas" name="salinitas" placeholder="Masukkan Salinitas">
                            </div>
                            <div class="form-group">
                                <label for="pencahayaan">Pencahayaan</label>
                                <input type="text" class="form-control" id="pencahayaan" name="pencahayaan" placeholder="Masukkan Intensitas Pencahayaan">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan Informasi</button>
                        </div>
                    </form>

                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
