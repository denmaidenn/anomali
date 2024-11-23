@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Edit Pelatihan</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Pelatihan</h5>

                    <div id="notification"></div>

                    <form id="editPelatihanForm" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="id_user">Pelatih</label>
                            <select class="form-control" id="id_user" name="id_user" required>
                                <option value="" disabled selected>Pilih Pelatih</option>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                            <div class="text-danger" id="error_id_user"></div>
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul Pelatihan</label>
                            <input name="judul" type="text" class="form-control" id="judul" placeholder="Masukkan judul pelatihan" required>
                            <div class="text-danger" id="error_judul"></div>
                        </div>

                        <div class="form-group">
                            <label for="video_pelatihan">Video Pelatihan</label>
                            <input name="video_pelatihan" type="file" class="form-control" id="video_pelatihan">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah video.</small>
                            <p id="currentVideoContainer"></p>
                            <div class="text-danger" id="error_video_pelatihan"></div>
                        </div>

                        <div class="form-group">
                            <label for="gambar_pelatihan">Gambar Pelatihan (Optional)</label>
                            <input name="gambar_pelatihan" type="file" class="form-control" id="gambar_pelatihan">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                            <div id="currentImageContainer"></div>
                            <div class="text-danger" id="error_gambar_pelatihan"></div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_pelatihan">Deskripsi Pelatihan</label>
                            <textarea name="deskripsi_pelatihan" class="form-control" id="deskripsi_pelatihan" rows="4" placeholder="Masukkan deskripsi pelatihan" required></textarea>
                            <div class="text-danger" id="error_deskripsi_pelatihan"></div>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input name="harga" type="number" class="form-control" id="harga" placeholder="Masukkan harga pelatihan" required>
                            <div class="text-danger" id="error_harga"></div>
                        </div>

                        <button type="button" id="submitButton" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pelatihan_ajax')
<script>
    const pelatihanId = {{ $pelatihan->id }}; // ID pelatihan yang diteruskan dari controller

    window.onload = function() {
        fetch(`/api/pelatihan/${pelatihanId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const pelatihan = data.data;

                    document.getElementById('judul').value = pelatihan.judul;
                    document.getElementById('deskripsi_pelatihan').value = pelatihan.deskripsi_pelatihan;
                    document.getElementById('harga').value = pelatihan.harga;

                    const pelatihSelect = document.getElementById('id_user');
                    if (Array.isArray(data.pelatih) && data.pelatih.length > 0) {
                        data.pelatih.forEach(trainer => {
                            let option = document.createElement('option');
                            option.value = trainer.id;
                            option.text = trainer.nama;
                            option.selected = trainer.id === pelatihan.id_user;
                            pelatihSelect.appendChild(option);
                        });
                    } else {
                        console.error('No pelatih data available');
                    }

                    if (pelatihan.video_pelatihan) {
                        const videoLink = document.createElement('a');
                        videoLink.href = `/storage/${pelatihan.video_pelatihan}`;
                        videoLink.target = "_blank";
                        videoLink.innerText = "Lihat Video";
                        document.getElementById('currentVideoContainer').appendChild(videoLink);
                    }

                    if (pelatihan.gambar_pelatihan) {
                        const imgElement = document.createElement('img');
                        imgElement.src = `/storage/${pelatihan.gambar_pelatihan}`;
                        imgElement.alt = "Gambar Pelatihan";
                        imgElement.width = 100;
                        document.getElementById('currentImageContainer').appendChild(imgElement);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Pelatihan tidak ditemukan.',
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching pelatihan data:', error);
            });
    };

    document.getElementById('submitButton').addEventListener('click', function(e) {
        e.preventDefault();

        const formData = new FormData(document.getElementById('editPelatihanForm'));
        formData.append('_method', 'PUT'); // Tambahkan _method untuk mengakali PUT dengan POST
        const token = 'yourActualTokenHere'; // Masukkan token autentikasi yang benar

        fetch(`/api/pelatihan/${pelatihanId}`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => Promise.reject(errorData));
            }
            return response.json();
        })
        .then(data => {
            if(data.success) {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Pelatihan berhasil diperbarui.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = "{{ route('pelatihan.index') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal memperbarui pelatihan.',
                });
            }
        })
        .catch(error => {
            console.error('Error updating pelatihan data:', error);
            if (error && error.errors) {
                Object.keys(error.errors).forEach(key => {
                    document.getElementById('error_' + key).innerText = error.errors[key].join(', ');
                });
            }
        });
    });

    // Fungsi pembantu untuk mengkapitalisasi huruf pertama
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>
@endsection
