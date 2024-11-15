@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Forms</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Edit User Data</h5>
                    <form id="userForm" class="forms-sample">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input name="name" type="text" class="form-control p-input" id="name" placeholder="Nama" required>
                            <div id="errorName" class="text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input name="email" type="email" class="form-control p-input" id="email" placeholder="Enter email" required>
                            <div id="errorEmail" class="text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input name="username" type="text" class="form-control p-input" id="username" placeholder="Username" required>
                            <div id="errorUsername" class="text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password (Kosongkan jika tidak ingin diubah)</label>
                            <input name="password" type="password" class="form-control p-input" id="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input name="no_telp" type="text" class="form-control p-input" id="no_telp" placeholder="Nomor Telepon">
                            <div id="errorNoTelp" class="text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control p-input" id="alamat" placeholder="Alamat"></textarea>
                            <div id="errorAlamat" class="text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label for="gambar_profile">Gambar Profil</label>
                            <input name="gambar_profile" type="file" class="form-control-file" id="gambar_profile">
                            <div id="currentImageContainer"></div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('user_ajax')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const userId = {{ $formuser->id }};
        const userForm = document.getElementById('userForm');

        // Fetch and populate user data
        fetch(`/api/formuser/${userId}`)
            .then(response => response.json())
            .then(response => {
                console.log("API Response:", response); // Log untuk melihat respons API
            
                if (response.success && response.data) {
                    const user = response.data; // Akses data user di dalam objek data
                
                    // Populate form fields
                    document.getElementById('name').value = user.name;
                    document.getElementById('email').value = user.email;
                    document.getElementById('username').value = user.username;
                    document.getElementById('no_telp').value = user.no_telp;
                    document.getElementById('alamat').value = user.alamat;
                
                    if (user.gambar_profile) {
                        const currentImageContainer = document.getElementById('currentImageContainer');
                        currentImageContainer.innerHTML = `
                            <img src="/storage/${user.gambar_profile}" alt="Profile Picture" width="100" height="100">
                            <p class="form-text text-muted">Gambar profil saat ini</p>
                        `;
                    }
                } else {
                    console.error('Error: User data not found or failed to fetch');
                }
            })
            .catch(error => console.error('Error fetching user data:', error));


        // Handle form submission
        userForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(userForm);
            fetch(`/api/formuser/${userId}`, {
                method: 'PUT',
                body: formData,

            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                    window.location.href = "{{ route('user.index') }}";
                }
            })
            .catch(error => {
                console.error('Error updating user data:', error);
            });
        });
    });
</script>
@endsection
