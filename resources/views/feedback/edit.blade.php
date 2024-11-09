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
                            <label for="exampleInputName1">User ID</label>
                            <input name="name" type="text" class="form-control p-input" id="exampleInputName1" placeholder="User ID" value="{{ old('name', $formUser->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Komentar</label>
                            <input name="email" type="email" class="form-control p-input" id="exampleInputEmail1" placeholder="Enter komentar" value="{{ old('email', $formUser->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
