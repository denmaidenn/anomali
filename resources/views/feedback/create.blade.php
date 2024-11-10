@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Form</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Feedback Form</h5>

                    <!-- Notifikasi sukses dan error -->
                    @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                    @endif
                    @if (session('error'))
                      <div class="alert alert-danger">
                        {{ session('error') }}
                      </div>
                    @endif

                    <form class="forms-sample" method="POST" action="{{ route('feedback.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="" disabled selected>Pilih User</option>
                                @foreach($formuser as $formusers)
                                    <option value="{{ $formusers->id }}">{{ $formusers->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="komentar">Komentar</label>
                            <textarea name="komentar" class="form-control p-input" id="komentar" placeholder="Masukkan komentar Anda" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
