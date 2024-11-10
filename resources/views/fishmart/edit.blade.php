@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Edit Fishpedia</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Edit Fishpedia</h5>
                    <form class="form-sample" method="POST" action="{{ route('fishpedia.update', $fishpedia->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Menggunakan PUT untuk update data -->

                        <div class="form-group">
                            <label for="nama_ilmiah">Nama Ilmiah</label>
                            <input name="nama_ilmiah" type="text" class="form-control p-input" id="nama_ilmiah" placeholder="Nama Ilmiah" value="{{ old('nama_ilmiah', $fishpedia->nama_ilmiah) }}" required>
                            @error('nama_ilmiah')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" class="form-control p-input" id="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Ikan Hias Air Tawar" {{ old('kategori', $fishpedia->kategori) == 'Ikan Hias Air Tawar' ? 'selected' : '' }}>Ikan Hias Air Tawar</option>
                                <option value="Ikan Hias Air Laut" {{ old('kategori', $fishpedia->kategori) == 'Ikan Hias Air Laut' ? 'selected' : '' }}>Ikan Hias Air Laut</option>
                                <option value="Koi" {{ old('kategori', $fishpedia->kategori) == 'Koi' ? 'selected' : '' }}>Koi</option>
                                <option value="Cupang" {{ old('kategori', $fishpedia->kategori) == 'Cupang' ? 'selected' : '' }}>Cupang</option>
                                <option value="Gabus" {{ old('kategori', $fishpedia->kategori) == 'Gabus' ? 'selected' : '' }}>Gabus</option>
                            </select>
                            @error('kategori')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="asal">Asal</label>
                            <input name="asal" type="text" class="form-control p-input" id="asal" placeholder="Asal" value="{{ old('asal', $fishpedia->asal) }}" required>
                            @error('asal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ukuran">Ukuran</label>
                            <input name="ukuran" type="text" class="form-control p-input" id="ukuran" placeholder="Ukuran" value="{{ old('ukuran', $fishpedia->ukuran) }}" required>
                            @error('ukuran')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="karakteristik">Karakteristik</label>
                            <textarea name="karakteristik" class="form-control p-input" id="karakteristik" placeholder="Karakteristik" rows="3">{{ old('karakteristik', $fishpedia->karakteristik) }}</textarea>
                            @error('karakteristik')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="akuarium">Akuarium</label>
                            <input name="akuarium" type="text" class="form-control p-input" id="akuarium" placeholder="Akuarium" value="{{ old('akuarium', $fishpedia->akuarium) }}" required>
                            @error('akuarium')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="suhu_ideal">Suhu Ideal</label>
                            <input name="suhu_ideal" type="number" class="form-control p-input" id="suhu_ideal" placeholder="Suhu Ideal" value="{{ old('suhu_ideal', $fishpedia->suhu_ideal) }}" required>
                            @error('suhu_ideal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ph_air">pH Air</label>
                            <input name="ph_air" type="number" step="0.1" class="form-control p-input" id="ph_air" placeholder="pH Air" value="{{ old('ph_air', $fishpedia->ph_air) }}" required>
                            @error('ph_air')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="salinitas">Salinitas</label>
                            <input name="salinitas" type="number" step="0.1" class="form-control p-input" id="salinitas" placeholder="Salinitas" value="{{ old('salinitas', $fishpedia->salinitas) }}" required>
                            @error('salinitas')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pencahayaan">Pencahayaan</label>
                            <input name="pencahayaan" type="text" class="form-control p-input" id="pencahayaan" placeholder="Pencahayaan" value="{{ old('pencahayaan', $fishpedia->pencahayaan) }}" required>
                            @error('pencahayaan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gambar_ikan">Gambar Ikan</label>
                            <input name="gambar_ikan" type="file" class="form-control-file" id="gambar_ikan">
                            <small class="form-text text-muted">Unggah gambar jika ingin mengganti gambar yang sudah ada.</small>
                            @if($fishpedia->gambar_ikan)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $fishpedia->gambar_ikan) }}" alt="Gambar Ikan" width="100">
                                </div>
                            @endif
                            @error('gambar_ikan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
