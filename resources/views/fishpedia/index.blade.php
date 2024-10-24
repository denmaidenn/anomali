@extends('layout.main')

@section('content')
<<<<<<< Updated upstream
<div class="container mt-5">
    <!-- Tombol Kembali -->
    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-4">← Kembali</a>

    <!-- Bagian Gambar dan Nama Ikan -->
    <div class="text-center">
        <img src="{{ asset('images/koi_slayer.jpg') }}" class="img-fluid" alt="{{ $fish->name }}" style="max-width: 400px;">
        <h2>{{ $fish->name }}</h2>
    </div>

    <!-- Informasi Detail Ikan -->
    <div class="card mt-4">
        <div class="card-body">
            <h4>Informasi Umum</h4>
            <p><strong>Nama Ilmiah:</strong> {{ $fish->scientific_name }}</p>
            <p><strong>Kategori:</strong> {{ $fish->category }}</p>

            <h4>Deskripsi Ikan</h4>
            <p><strong>Asal:</strong> {{ $fish->origin }}</p>
            <p><strong>Ukuran:</strong> {{ $fish->size }} cm</p>
            <p><strong>Karakteristik:</strong> {{ $fish->characteristics }}</p>

            <h4>Perawatan</h4>
            <p><strong>Akuarium:</strong> {{ $fish->aquarium_size }} L air</p>
            <p><strong>Suhu Ideal:</strong> {{ $fish->temperature }}°C</p>
            <p><strong>pH Air:</strong> {{ $fish->ph }}</p>
            <p><strong>Salinitas:</strong> {{ $fish->salinity }}</p>
            <p><strong>Pencahayaan:</strong> {{ $fish->lighting }}</p>
        </div>
    </div>
</div>
=======
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Data Ikan</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Masukan Data Ikan</h5>
                    <form class="forms-sample" method="POST" action="/formuser">
                        @csrf
                        <!-- Nama Ikan -->
                        <div class="form-group">
                            <label for="exampleInputName1">Nama Ikan</label>
                            <input name="name" type="text" class="form-control p-input" id="exampleInputName1" placeholder="Nama Ikan" required>
                        </div>

                        <!-- Nama Ilmiah -->
                        <div class="form-group">
                            <label for="exampleInputScientificName">Nama Ilmiah</label>
                            <input name="scientific_name" type="text" class="form-control p-input" id="exampleInputScientificName" placeholder="Nama Ilmiah" required>
                        </div>

                        <!-- Kategori -->
                        <div class="form-group">
                            <label for="exampleInputCategory">Kategori</label>
                            <input name="category" type="text" class="form-control p-input" id="exampleInputCategory" placeholder="Kategori" required>
                        </div>

                        <!-- Asal -->
                        <div class="form-group">
                            <label for="exampleInputOrigin">Asal</label>
                            <input name="origin" type="text" class="form-control p-input" id="exampleInputOrigin" placeholder="Asal" required>
                        </div>

                        <!-- Ukuran -->
                        <div class="form-group">
                            <label for="exampleInputSize">Ukuran</label>
                            <input name="size" type="text" class="form-control p-input" id="exampleInputSize" placeholder="Ukuran" required>
                        </div>

                        <!-- Karakteristik -->
                        <div class="form-group">
                            <label for="exampleInputCharacteristics">Karakteristik</label>
                            <input name="characteristics" type="text" class="form-control p-input" id="exampleInputCharacteristics" placeholder="Karakteristik" required>
                        </div>

                        <!-- Ukuran Akuarium -->
                        <div class="form-group">
                            <label for="exampleInputAquariumSize">Ukuran Akuarium (Liter)</label>
                            <input name="aquarium_size" type="number" class="form-control p-input" id="exampleInputAquariumSize" placeholder="Ukuran Akuarium (Liter)" required>
                        </div>

                        <!-- Suhu Ideal -->
                        <div class="form-group">
                            <label for="exampleInputTemperature">Suhu Ideal (°C)</label>
                            <input name="temperature" type="text" class="form-control p-input" id="exampleInputTemperature" placeholder="Suhu Ideal" required>
                        </div>

                        <!-- pH Air -->
                        <div class="form-group">
                            <label for="exampleInputPh">pH Air</label>
                            <input name="ph" type="text" class="form-control p-input" id="exampleInputPh" placeholder="pH Air" required>
                        </div>

                        <!-- Salinitas -->
                        <div class="form-group">
                            <label for="exampleInputSalinity">Salinitas</label>
                            <input name="salinity" type="text" class="form-control p-input" id="exampleInputSalinity" placeholder="Salinitas" required>
                        </div>

                        <!-- Pencahayaan -->
                        <div class="form-group">
                            <label for="exampleInputLighting">Pencahayaan</label>
                            <input name="lighting" type="text" class="form-control p-input" id="exampleInputLighting" placeholder="Pencahayaan" required>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    Fishpedia
</div>
>>>>>>> Stashed changes
@endsection
