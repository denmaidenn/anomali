@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Edit Admin</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                     <div class="d-flex justify-content-between m-2">
                        <h5 class="card-title mb-4">Edit Admin</h5>
                    </div>

                    <div id="notification"></div>

                    <!-- Form Edit Admin -->
                    <form id="editAdminForm" action="javascript:void(0);" method="POST" enctype="multipart/form-data">
                        <!-- Nama Admin -->
                        <div class="form-group">
                            <label for="name">Nama Admin</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Masukkan nama admin" required>
                            <div class="text-danger" id="error_name"></div>
                        </div>

                        <!-- Email Admin -->
                        <div class="form-group">
                            <label for="email">Email Admin</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="Masukkan email admin" required>
                            <div class="text-danger" id="error_email"></div>
                        </div>

                        <!-- Password Baru -->
                        <div class="form-group">
                            <label for="password">Password Baru (Opsional)</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Masukkan password baru">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                            <div class="text-danger" id="error_password"></div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Konfirmasi password baru">
                        </div>

                        <!-- Gambar Profil -->
                        <div class="form-group">
                            <label for="gambar_profile">Gambar Profil (Opsional)</label>
                            <input name="gambar_profile" type="file" class="form-control" id="gambar_profile">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar profil.</small>
                            <div id="currentImageContainer"></div>
                            <div class="text-danger" id="error_gambar_profile"></div>
                        </div>

                        <button type="submit" class="btn btn-primary" onclick="updateAdmin()">Simpan Perubahan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userId = {{ $user->id }};
        fetchAdminData(userId);
    });

    function fetchAdminData(userId) {
        fetch(`/api/admin/${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    const user = data.data;
                    document.getElementById('name').value = user.name;
                    document.getElementById('email').value = user.email;
                    if (user.gambar_profile) {
                        document.getElementById('currentImageContainer').innerHTML = 
                            `<img src="/storage/${user.gambar_profile}" alt="Gambar Profil" width="100">`;
                    }
                } else {
                    alert('Data pengguna tidak ditemukan.');
                }
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                alert('Terjadi kesalahan saat memuat data pengguna.');
            });
    }

    function updateAdmin() {
            const userId = {{ Auth::user()->id }};
            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            if (!csrfToken) {
                alert('CSRF token tidak ditemukan!');
                return;
            }

            const form = document.getElementById('editAdminForm');
            const formData = new FormData(form);
            formData.append('_method', 'PUT');

            fetch(`/api/admin/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken.content,
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User updated successfully!');

                    window.location.href = `/admin/${userId}/show`;;
                } else {
                    alert('Failed to update user.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }



</script>
@endsection
