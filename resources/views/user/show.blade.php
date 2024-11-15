@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail User</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0" id="userName"></h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Nama:</strong>
                        </div>
                        <div class="col-md-8">
                            <p id="userNameDetail">Loading...</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            <p id="userEmail">Loading...</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Username:</strong>
                        </div>
                        <div class="col-md-8">
                            <p id="userUsername">Loading...</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Nomor Telepon:</strong>
                        </div>
                        <div class="col-md-8">
                            <p id="userPhone">Loading...</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Alamat:</strong>
                        </div>
                        <div class="col-md-8">
                            <p id="userAddress">Loading...</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Gambar Profil:</strong>
                        </div>
                        <div class="col-md-8">
                            <img id="userProfileImage" src="" alt="Profile Picture" width="100" height="100" style="display: none;">
                            <p id="noProfileImage" style="display: none;">Tidak ada gambar profil.</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Tanggal Bergabung:</strong>
                        </div>
                        <div class="col-md-8">
                            <p id="userJoinDate">Loading...</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary me-2">Kembali ke Daftar User</a>
                        <a href="{{ route('user.edit', $formuser->id) }}" class="btn btn-primary">Edit User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userId = {{ $formuser->id }}; // Get user ID passed from the controller
        const userNameElement = document.getElementById('userName');
        const userNameDetailElement = document.getElementById('userNameDetail');
        const userEmailElement = document.getElementById('userEmail');
        const userUsernameElement = document.getElementById('userUsername');
        const userPhoneElement = document.getElementById('userPhone');
        const userAddressElement = document.getElementById('userAddress');
        const userProfileImageElement = document.getElementById('userProfileImage');
        const noProfileImageElement = document.getElementById('noProfileImage');
        const userJoinDateElement = document.getElementById('userJoinDate');

        // Fetch user data from the API
        fetch(`/api/formuser/${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    const user = data.data;

                    // Update DOM with the user data
                    userNameElement.textContent = user.name;
                    userNameDetailElement.textContent = user.name || 'Tidak ada nama.';
                    userEmailElement.textContent = user.email || 'Tidak ada email.';
                    userUsernameElement.textContent = user.username || 'Tidak ada username.';
                    userPhoneElement.textContent = user.no_telp || 'Tidak ada nomor telepon.';
                    userAddressElement.textContent = user.alamat || 'Tidak ada alamat.';
                    userJoinDateElement.textContent = new Date(user.created_at).toLocaleDateString('id-ID') || 'Tidak ada tanggal bergabung.';

                    if (user.gambar_profile) {
                        userProfileImageElement.src = `/storage/${user.gambar_profile}`;
                        userProfileImageElement.style.display = 'block';
                        noProfileImageElement.style.display = 'none';
                    } else {
                        noProfileImageElement.style.display = 'block';
                        userProfileImageElement.style.display = 'none';
                    }
                } else {
                    alert('User tidak ditemukan.');
                }
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                alert('Terjadi kesalahan saat memuat data pengguna.');
            });
    });
</script>
@endsection
