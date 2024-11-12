@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Forms</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Edit Feedback</h5>
                    <form class="forms-sample" method="POST" action="{{ route('feedback.update', $feedback->id) }}">
                        @csrf
                        @method('PUT') <!-- Menggunakan PUT untuk update data -->

                        <!-- Dropdown untuk memilih User -->
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="" disabled>Pilih User</option>
                                @foreach($formusers as $formuser)
                                    <option value="{{ $formuser->id }}" {{ $formuser->id == $feedback->user_id ? 'selected' : '' }}>
                                        {{ $formuser->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="komentar">Komentar</label>
                            <textarea name="komentar" class="form-control p-input" id="komentar" placeholder="Masukkan komentar Anda" required>{{ old('komentar', $feedback->komentar) }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
