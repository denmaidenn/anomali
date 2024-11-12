@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail User</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $formuser->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Nama:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $formuser->name ?? 'Tidak ada nama.' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $formuser->email ?? 'Tidak ada email.' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Username:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $formuser->username ?? 'Tidak ada username.' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Tanggal Bergabung:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $formuser->created_at->format('d M Y') }}</p>
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
