@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail Admin</h3>
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
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">Kembali</a>
                        <a href="{{ route('sign.edit', $user->id) }}" class="btn btn-primary">Edit Admin</a>
                        <a onclick="deleteUser({{ $user->id }})" class="btn btn-danger">
                            <img src="{{ asset('images/bin.png') }}" alt="Delete" style="width: 20px; height: 20px; object-fit: contain;">
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

tolong rapihkan design ini

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userId = {{ $user->id }}; // Get user ID passed from the controller
        const userNameElement = document.getElementById('userName');
        const userNameDetailElement = document.getElementById('userNameDetail');
        const userEmailElement = document.getElementById('userEmail');
        const userProfileImageElement = document.getElementById('userProfileImage');
        const noProfileImageElement = document.getElementById('noProfileImage');
        const userJoinDateElement = document.getElementById('userJoinDate');

        // Fetch user data from the API
        fetch(`/api/admin/${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    const user = data.data;

                    // Update DOM with the user data
                    userNameElement.textContent = user.name;
                    userNameDetailElement.textContent = user.name || 'Tidak ada nama.';
                    userEmailElement.textContent = user.email || 'Tidak ada email.';
                    userJoinDateElement.textContent = new Date(user.created_at).toLocaleDateString('id-ID') || 'Tidak ada tanggal bergabung.';

                    // Handle Profile Image
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

    function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // Make an AJAX request to delete the user
        fetch(`/api/admin/${userId}`, {  // Correct the URL to just /admin/{userId}
            method: 'DELETE', // HTTP DELETE method
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token') // Replace with actual token if needed
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('User deleted successfully');
                location.reload(); // Reload the page to update the UI
            } else {
                alert('Failed to delete the user: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the user.');
        });
    }
}
</script>
@endsection

