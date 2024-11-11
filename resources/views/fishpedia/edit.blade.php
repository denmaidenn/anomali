@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Edit Fishpedia</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Edit Fishpedia</h5>
                        <form method="POST" action="{{ route('fishpedia.update', $fish->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Menggunakan PUT untuk update -->
                        
                        <!-- Nama Ilmiah -->
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $fish->name) }}" required>
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        
                        <!-- Nama Ilmiah -->
                        <div class="form-group">
                            <label for="nama_ilmiah">Nama Ilmiah</label>
                            <input name="nama_ilmiah" type="text" class="form-control" id="nama_ilmiah" value="{{ old('nama_ilmiah', $fish->nama_ilmiah) }}" required>
                            @error('nama_ilmiah') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- Kategori -->
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" class="form-control" id="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Ikan Hias Air Tawar" {{ old('kategori', $fish->kategori) == 'Ikan Hias Air Tawar' ? 'selected' : '' }}>Ikan Hias Air Tawar</option>
                                <option value="Ikan Hias Air Laut" {{ old('kategori', $fish->kategori) == 'Ikan Hias Air Laut' ? 'selected' : '' }}>Ikan Hias Air Laut</option>
                                <option value="Koi" {{ old('kategori', $fish->kategori) == 'Koi' ? 'selected' : '' }}>Koi</option>
                                <option value="Cupang" {{ old('kategori', $fish->kategori) == 'Cupang' ? 'selected' : '' }}>Cupang</option>
                                <option value="Gabus" {{ old('kategori', $fish->kategori) == 'Gabus' ? 'selected' : '' }}>Gabus</option>
                            </select>
                            @error('kategori') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- Asal -->
                        <div class="form-group">
                            <label for="asal">Asal</label>
                            <input name="asal" type="text" class="form-control" id="asal" value="{{ old('asal', $fish->asal) }}" required>
                            @error('asal') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- Ukuran -->
                        <div class="form-group">
                            <label for="ukuran">Ukuran</label>
                            <input name="ukuran" type="text" class="form-control" id="ukuran" value="{{ old('ukuran', $fish->ukuran) }}" required>
                            @error('ukuran') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- Karakteristik -->
                        <div class="form-group">
                            <label for="karakteristik">Karakteristik</label>
                            <textarea name="karakteristik" class="form-control" id="karakteristik">{{ old('karakteristik', $fish->karakteristik) }}</textarea>
                            @error('karakteristik') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- Akuarium -->
                        <div class="form-group">
                            <label for="akuarium">Akuarium</label>
                            <input name="akuarium" type="text" class="form-control" id="akuarium" value="{{ old('akuarium', $fish->akuarium) }}" required>
                            @error('akuarium') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- Suhu Ideal -->
                        <div class="form-group">
                            <label for="suhu_ideal">Suhu Ideal</label>
                            <input name="suhu_ideal" type="number" class="form-control" id="suhu_ideal" value="{{ old('suhu_ideal', $fish->suhu_ideal) }}" required>
                            @error('suhu_ideal') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- pH Air -->
                        <div class="form-group">
                            <label for="ph_air">pH Air</label>
                            <input name="ph_air" type="number" step="0.1" class="form-control" id="ph_air" value="{{ old('ph_air', $fish->ph_air) }}" required>
                            @error('ph_air') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- Salinitas -->
                        <div class="form-group">
                            <label for="salinitas">Salinitas</label>
                            <input name="salinitas" type="number" step="0.1" class="form-control" id="salinitas" value="{{ old('salinitas', $fish->salinitas) }}" required>
                            @error('salinitas') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- Pencahayaan -->
                        <div class="form-group">
                            <label for="pencahayaan">Pencahayaan</label>
                            <input name="pencahayaan" type="text" class="form-control" id="pencahayaan" value="{{ old('pencahayaan', $fish->pencahayaan) }}" required>
                            @error('pencahayaan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <!-- Gambar Ikan -->
                        <div class="form-group">
                            <label for="gambar_ikan">Gambar Ikan</label>
                            <input name="gambar_ikan" type="file" class="form-control" id="gambar_ikan" accept="image/*">
                            @error('gambar_ikan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('fishpedia.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
