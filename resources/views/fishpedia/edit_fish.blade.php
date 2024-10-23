@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Edit Fish Data</h3>
    
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('updateikan', $fish->id) }}" method="POST">
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
                            <label for="name">Nama Ikan</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $fish->name) }}" required>
                        </div>

                        <!-- Nama Ilmiah -->
                        <div class="form-group">
                            <label for="scientific_name">Nama Ilmiah</label>
                            <input type="text" name="scientific_name" class="form-control" value="{{ old('scientific_name', $fish->scientific_name) }}" required>
                        </div>

                        <!-- Kategori -->
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category', $fish->category) }}" required>
                        </div>

                        <!-- Asal -->
                        <div class="form-group">
                            <label for="origin">Asal</label>
                            <input type="text" name="origin" class="form-control" value="{{ old('origin', $fish->origin) }}" required>
                        </div>

                        <!-- Ukuran -->
                        <div class="form-group">
                            <label for="size">Ukuran (cm)</label>
                            <input type="text" name="size" class="form-control" value="{{ old('size', $fish->size) }}" required>
                        </div>

                        <!-- Karakteristik -->
                        <div class="form-group">
                            <label for="characteristics">Karakteristik</label>
                            <input type="text" name="characteristics" class="form-control" value="{{ old('characteristics', $fish->characteristics) }}" required>
                        </div>

                        <!-- Akuarium -->
                        <div class="form-group">
                            <label for="aquarium_size">Ukuran Akuarium</label>
                            <input type="text" name="aquarium_size" class="form-control" value="{{ old('aquarium_size', $fish->aquarium_size) }}" required>
                        </div>

                        <!-- Suhu Ideal -->
                        <div class="form-group">
                            <label for="temperature">Suhu Ideal (°C)</label>
                            <input type="text" name="temperature" class="form-control" value="{{ old('temperature', $fish->temperature) }}" required>
                        </div>

                        <!-- pH Air -->
                        <div class="form-group">
                            <label for="ph">pH Air</label>
                            <input type="text" name="ph" class="form-control" value="{{ old('ph', $fish->ph) }}" required>
                        </div>

                        <!-- Salinitas -->
                        <div class="form-group">
                            <label for="salinity">Salinitas</label>
                            <input type="text" name="salinity" class="form-control" value="{{ old('salinity', $fish->salinity) }}" required>
                        </div>

                        <!-- Pencahayaan -->
                        <div class="form-group">
                            <label for="lighting">Pencahayaan</label>
                            <input type="text" name="lighting" class="form-control" value="{{ old('lighting', $fish->lighting) }}" required>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update Fish Data</button>
                            <a href="/fishpedia" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
