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


                        <button type="button" id="submitButton" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('pelatihanfree.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pelatihan_ajax')
<script>
    // Pastikan ID pelatihan terdefinisi dengan benar
    const pelatihanId = {{ $pelatihan->id }}; // ID pelatihan yang diteruskan dari controller

    // Fetch data pelatihan dan populasi form saat halaman dimuat
    window.onload = function() {
        fetch(`/api/pelatihanfree/${pelatihanId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const pelatihan = data.data;

                    // Isi field form dengan data pelatihan
                    document.getElementById('judul').value = pelatihan.judul;
                    document.getElementById('deskripsi_pelatihan').value = pelatihan.deskripsi_pelatihan;

                    // Populate dropdown untuk memilih pelatih
                    const pelatihSelect = document.getElementById('id_user');
                    if (Array.isArray(data.pelatih) && data.pelatih.length > 0) {
                        data.pelatih.forEach(trainer => {
                            let option = document.createElement('option');
                            option.value = trainer.id;
                            option.text = trainer.nama;
                            option.selected = trainer.id === pelatihan.id_user; // Tandai pelatih yang sudah dipilih
                            pelatihSelect.appendChild(option);
                        });
                    } else {
                        console.error('No pelatih data available');
                    }

                    // Menampilkan video jika ada
                    if (pelatihan.video_pelatihan) {
                        const videoLink = document.createElement('a');
                        videoLink.href = `/storage/${pelatihan.video_pelatihan}`;
                        videoLink.target = "_blank";
                        videoLink.innerText = "Lihat Video";
                        document.getElementById('currentVideoContainer').appendChild(videoLink);
                    }

                    // Menampilkan gambar pelatihan jika ada
                    if (pelatihan.gambar_pelatihan) {
                        const imgElement = document.createElement('img');
                        imgElement.src = `/storage/${pelatihan.gambar_pelatihan}`;
                        imgElement.alt = "Gambar Pelatihan";
                        imgElement.width = 100;
                        document.getElementById('currentImageContainer').appendChild(imgElement);
                    }
                } else {
                    // Jika data gagal dimuat
                    console.error('Pelatihan tidak ditemukan');
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
        method: 'POST', // Gunakan POST, karena kita mengakali PUT dengan _method
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
        console.log("Response data:", data);

        if(data.success) {
            console.log(data)
            alert(data.message);
        // Arahkan ke halaman index pelatihan
        window.location.href = "{{ route('pelatihanfree.index') }}";
        } else {
            alert('Failed to update');
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
