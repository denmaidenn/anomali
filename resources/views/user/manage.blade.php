@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Forms</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Edit User Data</h5>
                    <form class="forms-sample" method="POST" action="{{ route('user.update', $formUser->id) }}">
                        @csrf
                        @method('PUT') <!-- Menggunakan PUT untuk update data -->

                        <div class="form-group">
                            <label for="exampleInputName1">Nama</label>
                            <input name="name" type="text" class="form-control p-input" id="exampleInputName1" placeholder="Nama" value="{{ old('name', $formUser->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control p-input" id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email', $formUser->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputNoTelp">No Telepon</label>
                            <input name="no_telp" type="text" class="form-control p-input" id="exampleInputNoTelp" placeholder="No Telepon" value="{{ old('no_telp', $formUser->no_telp) }}" required>
                            @error('no_telp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputUsername">Username</label>
                            <input name="username" type="text" class="form-control p-input" id="exampleInputUsername" placeholder="Username" value="{{ old('username', $formUser->username) }}" required>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword">Password (Kosongkan jika tidak ingin diubah)</label>
                            <input name="password" type="password" class="form-control p-input" id="exampleInputPassword" placeholder="Password">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
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
