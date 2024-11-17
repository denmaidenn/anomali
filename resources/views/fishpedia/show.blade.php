@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail Fishpedia</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0" id="fish-name">Loading...</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Nama Ilmiah:</div>
                        <div class="col-md-8" id="scientific-name">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Kategori:</div>
                        <div class="col-md-8" id="category">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Asal:</div>
                        <div class="col-md-8" id="origin">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Ukuran:</div>
                        <div class="col-md-8" id="size">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Karakteristik:</div>
                        <div class="col-md-8" id="characteristics">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Akuarium:</div>
                        <div class="col-md-8" id="aquarium">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Suhu Ideal:</div>
                        <div class="col-md-8" id="ideal-temperature">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">pH Air:</div>
                        <div class="col-md-8" id="ph-water">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Salinitas:</div>
                        <div class="col-md-8" id="salinity">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Pencahayaan:</div>
                        <div class="col-md-8" id="lighting">Loading...</div>
                    </div>
                    <!-- Gambar Ikan -->
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Gambar Ikan:</div>
                        <div class="col-md-8" id="fish-image">
                            <p class="text-muted">Loading...</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('fishpedia.index') }}" class="btn btn-secondary me-2">Kembali ke Daftar Fishpedia</a>
                        <a href="{{ route('fishpedia.edit', $fish->id) }}" class="btn btn-primary">Edit Ikan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Mendapatkan ID ikan dari URL
    const fishId = {{ $fish->id }};
    
    // Mengambil data ikan dari API menggunakan fetch
    fetch(`/api/fishpedia/${fishId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Menampilkan data ikan di halaman
                console.log(data);
                const fish = data.data;
                document.getElementById('fish-name').textContent = fish.nama;
                document.getElementById('scientific-name').textContent = fish.nama_ilmiah || 'Tidak ada nama ilmiah';
                document.getElementById('category').textContent = fish.kategori || 'Tidak ada kategori';
                document.getElementById('origin').textContent = fish.asal || 'Tidak ada informasi asal';
                document.getElementById('size').textContent = fish.ukuran || 'Ukuran tidak diketahui';
                document.getElementById('characteristics').textContent = fish.karakteristik || 'Karakteristik tidak diketahui';
                document.getElementById('aquarium').textContent = fish.akuarium ? `${fish.akuarium} L` : 'Tidak ada informasi ukuran akuarium';
                document.getElementById('ideal-temperature').textContent = fish.suhu_ideal ? `${fish.suhu_ideal} °C` : 'Suhu ideal tidak diketahui';
                document.getElementById('ph-water').textContent = fish.ph_air || 'Tidak ada informasi pH';
                document.getElementById('salinity').textContent = fish.salinitas || 'Salinitas tidak diketahui';
                document.getElementById('lighting').textContent = fish.pencahayaan || 'Pencahayaan tidak diketahui';
                
                const fishImage = fish.gambar_ikan ? `<img src="/storage/${fish.gambar_ikan}" alt="Gambar Ikan" class="img-fluid rounded shadow-sm" width="200">` : '<p class="text-muted">Tidak ada gambar.</p>';
                document.getElementById('fish-image').innerHTML = fishImage;
            } else {
                alert('Data Fishpedia tidak ditemukan');
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
</script>
@endsection
