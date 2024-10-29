@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Tambah Pelatihan Baru</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Tambah Data Pelatihan</h5>

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

                    <!-- Form untuk menambah pelatihan baru -->
                    <form id="pelatihan-form" action="{{ route('pelatihan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="user_id">User ID</label>
                            <input type="number" class="form-control" id="user_id" name="user_id" placeholder="Masukkan ID user" required>
                        </div>

                        <div class="form-group">
                            <label for="video_pelatihan">Video Pelatihan</label>
                            <input type="text" class="form-control" id="video_pelatihan" name="video_pelatihan" placeholder="Masukkan URL video pelatihan" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_pelatihan">Deskripsi Pelatihan</label>
                            <textarea class="form-control" id="deskripsi_pelatihan" name="deskripsi_pelatihan" rows="4" placeholder="Masukkan deskripsi pelatihan" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga pelatihan" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/pelatihan" class="btn btn-secondary">Kembali</a>
                    </form>

                    <!-- Area untuk menampilkan notifikasi setelah AJAX submit -->
                    <div id="ajax-notification" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pelatihan-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Clear the form
                    $('#pelatihan-form')[0].reset();

                    // Display success message
                    $('#ajax-notification').html('<div class="alert alert-success">' + response.message + '</div>');
                },
                error: function(xhr) {
                    // Display error messages
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>'; // Display the first error message for each field
                    });
                    errorHtml += '</ul></div>';
                    $('#ajax-notification').html(errorHtml);
                }
            });
        });
    });
</script>
@endsection
