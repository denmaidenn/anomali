@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Edit Fishpedia</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Edit Fishpedia</h5>
                    <form id="editFishForm" enctype="multipart/form-data">
                        <!-- Nama Ilmiah -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input name="nama" type="text" class="form-control" id="nama" required>
                            <div class="text-danger" id="error_nama"></div>
                        </div>
                        
                        <!-- Nama Ilmiah -->
                        <div class="form-group">
                            <label for="nama_ilmiah">Nama Ilmiah</label>
                            <input name="nama_ilmiah" type="text" class="form-control" id="nama_ilmiah" required>
                            <div class="text-danger" id="error_nama_ilmiah"></div>
                        </div>
                    
                        <!-- Kategori -->
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" class="form-control" id="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Ikan Hias Air Tawar">Ikan Hias Air Tawar</option>
                                <option value="Ikan Hias Air Laut">Ikan Hias Air Laut</option>
                                <option value="Koi">Koi</option>
                                <option value="Cupang">Cupang</option>
                                <option value="Gabus">Gabus</option>
                            </select>
                            <div class="text-danger" id="error_kategori"></div>
                        </div>
                    
                        <div class="form-group">
                            <label for="asal">Asal</label>
                            <input name="asal" type="text" class="form-control" id="asal" required>
                            <div class="text-danger" id="error_asal"></div>
                        </div>

                        <div class="form-group">
                            <label for="ukuran">Ukuran</label>
                            <input name="ukuran" type="text" class="form-control" id="ukuran" required>
                            <div class="text-danger" id="error_ukuran"></div>
                        </div>

                        <div class="form-group">
                            <label for="karakteristik">Karakteristik</label>
                            <textarea name="karakteristik" class="form-control" id="karakteristik"></textarea>
                            <div class="text-danger" id="error_karakteristik"></div>
                        </div>
                    
                        <!-- Akuarium -->
                        <div class="form-group">
                            <label for="akuarium">Akuarium</label>
                            <input name="akuarium" type="text" class="form-control" id="akuarium" required>
                            <div class="text-danger" id="error_akuarium"></div>
                        </div>
                    
                        <!-- Suhu Ideal -->
                        <div class="form-group">
                            <label for="suhu_ideal">Suhu Ideal</label>
                            <input name="suhu_ideal" type="number" class="form-control" id="suhu_ideal" required>
                            <div class="text-danger" id="error_suhu"></div> 
                        </div>
                    
                        <!-- pH Air -->
                        <div class="form-group">
                            <label for="ph_air">pH Air</label>
                            <input name="ph_air" type="number" step="0.1" class="form-control" id="ph_air" required>
                            <div class="text-danger"></div> 
                        </div>
                    
                        <!-- Salinitas -->
                        <div class="form-group">
                            <label for="salinitas">Salinitas</label>
                            <input name="salinitas" type="text"  class="form-control" id="salinitas" required>
                            <div class="text-danger"></div>
                        </div>
                    
                        <!-- Pencahayaan -->
                        <div class="form-group">
                            <label for="pencahayaan">Pencahayaan</label>
                            <input name="pencahayaan" type="text" class="form-control" id="pencahayaan" required>
                            <div class="text-danger"></div>
                        </div>
                    
                        <!-- Gambar Ikan -->
                        <div class="form-group">
                            <label for="gambar_ikan">Gambar Ikan</label>
                            <input name="gambar_ikan" type="file" class="form-control" id="gambar_ikan" accept="image/*">
                            <div class="text-danger" id="error_gambar_ikan"></div>
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>

                        </div>

                        <!-- Container to display the current fish image -->
                        <div id="gambarContainer" class="mt-3" style="margin-bottom: 20px;"></div>

                        <button type="button" id="submitButton" class="btn btn-primary">Update</button>
                        <a href="{{ route('fishpedia.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        const fishId = {{ $fish->id }};

        window.onload = function() {
            fetch(`/api/fishpedia/${fishId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        
                        const fish = data.data;

                        document.getElementById('nama').value = fish.nama;
                        document.getElementById('nama_ilmiah').value = fish.nama_ilmiah;
                        document.getElementById('kategori').value = fish.kategori;
                        document.getElementById('asal').value = fish.asal;
                        document.getElementById('ukuran').value = fish.ukuran;
                        document.getElementById('karakteristik').value = fish.karakteristik;
                        document.getElementById('akuarium').value = fish.akuarium;
                        document.getElementById('suhu_ideal').value = fish.suhu_ideal;
                        document.getElementById('ph_air').value = fish.ph_air;
                        document.getElementById('salinitas').value = fish.salinitas;
                        document.getElementById('pencahayaan').value = fish.pencahayaan;

                        const gambarContainer = document.getElementById('gambarContainer');
                        if (fish.gambar_ikan) {
                            const imgElement = document.createElement("img");
                            imgElement.src = `/storage/${fish.gambar_ikan}`;
                            imgElement.alt = "Gambar Ikan";
                            imgElement.id = "currentImage";
                            imgElement.classList.add("img-fluid", "rounded", "shadow-sm");
                            imgElement.width = 200;
                            gambarContainer.appendChild(imgElement);
                        }
                    }
            }).then(() => {
                if (data.success) {
            // Menggunakan SweetAlert untuk menampilkan pesan sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message,
                    }).then(() => {
                // Redirect
                        window.location.href = "{{ route('fishpedia.index') }}";
            });
                    } else {
                        console.error('Fishpedia entry not found');
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal memperbarui data ikan',
            });
                    }
                })
                .catch(error => {
                    console.error('Error fetching fish data:', error);
                });
        };

        document.getElementById('submitButton').addEventListener('click', function(e) {
            e.preventDefault();

            const formData = new FormData(document.getElementById('editFishForm'));
            formData.append('_method', 'PUT'); // Workaround for PUT
            const token = 'yourActualTokenHere'; // Masukkan token autentikasi yang benar

            // Menambahkan SweetAlert sebelum menghapus gambar
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ikan akan diperbarui!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, perbarui!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/api/fishpedia/${fishId}`, {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => {
                        console.log("Status:", response.status);
                        console.log("Headers:", response.headers);
                        if (!response.ok) {
                            return response.json().then(errorData => Promise.reject(errorData));
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Menggunakan SweetAlert untuk menampilkan pesan sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                            }).then(() => {
                                // Update or create image element
                                const imgElement = document.getElementById("currentImage") || document.createElement("img");
                                imgElement.src = `/storage/${data.data.gambar_ikan}`;
                                imgElement.alt = "Gambar Ikan";
                                imgElement.id = "currentImage";
                                imgElement.classList.add("img-fluid", "rounded", "shadow-sm");
                                imgElement.width = 200;
                                document.getElementById('gambarContainer').appendChild(imgElement);

                                // Redirect
                                window.location.href = "{{ route('fishpedia.index') }}";
                            });
                        } else {
                            alert('Failed to update fish data');
                        }
                    })
                    .catch(error => {
                        if (error && error.errors) {
                            Object.keys(error.errors).forEach(key => {
                                const errorElement = document.getElementById('error_' + key);
                                if (errorElement) {
                                    errorElement.innerText = error.errors[key].join(', ');
                                }
                            });
                        }
                        console.error('Error updating fish data:', error);
                    });
                }
            });
        });
    </script>
@endsection


