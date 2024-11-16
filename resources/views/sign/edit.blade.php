@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Edit Admin</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Edit Data Admin</h5>

                    <div id="notification"></div>

                    <form id="editAdminForm" action="{{ route('sign.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama Admin</label>
                            <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama admin" required>
                            <div class="text-danger" id="error_name"></div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Admin</label>
                            <input name="email" type="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email admin" required>
                            <div class="text-danger" id="error_email"></div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password Baru (Opsional)</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Masukkan password baru">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                            <div class="text-danger" id="error_password"></div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Konfirmasi password baru">
                        </div>

                        <div class="form-group">
                            <label for="gambar_profile">Gambar Profil (Opsional)</label>
                            <input name="gambar_profile" type="file" class="form-control" id="gambar_profile">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar profil.</small>
                            @if($user->gambar_profile)
                                <div id="currentImageContainer">
                                    <img src="{{ Storage::url($user->gambar_profile) }}" alt="Gambar Profil" width="100">
                                </div>
                            @endif
                            <div class="text-danger" id="error_gambar_profile"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
