@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Edit Pelatih</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Edit Data Pelatih</h5>

                    <div id="notification"></div>

                    <form id="editPelatihForm">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama pelatih" required>
                            <div class="text-danger" id="error_nama"></div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email pelatih" required>
                            <div class="text-danger" id="error_email"></div>
                        </div>

                        <div class="form-group">
                            <label for="no_telp">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon" required>
                            <div class="text-danger" id="error_no_telp"></div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat pelatih"></textarea>
                            <div class="text-danger" id="error_alamat"></div>
                        </div>

                        <button type="button" id="submitButton" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('pelatih.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pelatih_ajax')
<script>
    // Pastikan ID pelatih terdefinisi dengan benar
    document.addEventListener('DOMContentLoaded', function () {
        const pelatihId = {{ $pelatih->id ?? 'null' }};
        if (!pelatihId) {
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'Pelatih ID tidak ditemukan. Pastikan data pelatih ada.',
            });
            return;
        }

        console.log("Fetching pelatih data with ID:", pelatihId);

        fetch(`/api/pelatih/${pelatihId}`, {
            headers: {
                'Accept': 'application/json',
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.data) {
                    console.log('Pelatih data:', data.data);
                    document.getElementById('nama').value = data.data.nama || '';
                    document.getElementById('email').value = data.data.email || '';
                    document.getElementById('no_telp').value = data.data.no_telp || '';
                    document.getElementById('alamat').value = data.data.alamat || '';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Pelatih tidak ditemukan.',
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching pelatih data:', error);
            });

        document.getElementById('submitButton').addEventListener('click', function (e) {
            e.preventDefault();

            const formData = new FormData(document.getElementById('editPelatihForm'));
            formData.append('_method', 'PUT'); // Akali PUT menggunakan POST

            fetch(`/api/pelatih/${pelatihId}`, {
                method: 'POST', // Gunakan POST
                headers: {
                    'Accept': 'application/json',
                },
                body: formData,
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => Promise.reject(errorData));
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pelatih berhasil diperbarui.',
                        }).then(() => {
                            window.location.href = "{{ route('pelatih.index') }}"; // Redirect ke halaman index
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal memperbarui pelatih.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error updating pelatih:', error);
                    if (error.errors) {
                        Object.keys(error.errors).forEach(key => {
                            document.getElementById(`error_${key}`).innerText = error.errors[key].join(', ');
                        });
                    }
                });
        });
    });
</script>
@endsection
