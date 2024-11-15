@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Forms</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Edit User Data</h5>
                    <form class="forms-sample" method="POST" action="{{ route('user.update', $formuser->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input name="name" type="text" class="form-control p-input" id="name" placeholder="Nama" value="{{ old('name', $formuser->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input name="email" type="email" class="form-control p-input" id="email" placeholder="Enter email" value="{{ old('email', $formuser->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input name="username" type="text" class="form-control p-input" id="username" placeholder="Username" value="{{ old('username', $formuser->username) }}" required>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password (Kosongkan jika tidak ingin diubah)</label>
                            <input name="password" type="password" class="form-control p-input" id="password" placeholder="Password">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                        </div>

                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input name="no_telp" type="text" class="form-control p-input" id="no_telp" placeholder="Nomor Telepon" value="{{ old('no_telp', $formuser->no_telp) }}">
                            @error('no_telp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control p-input" id="alamat" placeholder="Alamat">{{ old('alamat', $formuser->alamat) }}</textarea>
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gambar_profile">Gambar Profil</label>
                            <input name="gambar_profile" type="file" class="form-control-file" id="gambar_profile">
                            <small class="form-text text-muted">Unggah gambar profil baru jika ingin mengubahnya.</small>
                            @error('gambar_profile')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @if ($formuser->gambar_profile)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $formuser->gambar_profile) }}" alt="Profile Picture" width="100" height="100">
                                    <p class="form-text text-muted">Gambar profil saat ini</p>
                                </div>
                            @endif
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
    const userId = {{ $formuser->id }}; // User ID passed from the controller

    // Fetch user data from the API
    window.onload = function() {
        fetch(`/api/formuser/${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.user) {
                    const user = data.user;

                    // Pre-fill form fields with the user data
                    document.getElementById('name').value = user.name;
                    document.getElementById('email').value = user.email;
                    document.getElementById('username').value = user.username;
                    document.getElementById('no_telp').value = user.no_telp;
                    document.getElementById('alamat').value = user.alamat;

                    if (user.gambar_profile) {
                        const imgElement = document.createElement('img');
                        imgElement.src = `/storage/${user.gambar_profile}`;
                        imgElement.alt = "Profile Picture";
                        imgElement.width = 100;
                        imgElement.height = 100;

                        const currentImageContainer = document.getElementById('currentImageContainer');
                        currentImageContainer.appendChild(imgElement);
                    }
                }
            })
            .catch(error => console.error('Error fetching user data:', error));
    };

    // Handle form submission
    document.getElementById('userForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        
        fetch(`/api/formuser/${userId}`, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${yourAuthToken}`,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message); // Success message
                window.location.href = "{{ route('user.index') }}"; // Redirect to user list
            }
        })
        .catch(error => {
            console.error('Error updating user data:', error);
            if (error.response && error.response.data) {
                const errors = error.response.data.errors;

                // Display validation errors in the form
                Object.keys(errors).forEach(key => {
                    document.getElementById('error' + capitalizeFirstLetter(key)).innerText = errors[key].join(', ');
                });
            }
        });
    });

    // Helper function to capitalize the first letter of string
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>
@endsection
