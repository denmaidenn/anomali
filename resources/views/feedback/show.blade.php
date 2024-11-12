@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail Feedback</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Feedback oleh {{ $feedback->user->name ?? 'User Tidak Ditemukan' }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>User:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $feedback->user->name ?? 'Tidak ada user.' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Komentar:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $feedback->komentar ?? 'Tidak ada komentar.' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Tanggal Dibuat:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $feedback->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('feedback.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-primary">Edit Feedback</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
