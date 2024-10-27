@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Tambah Ikan Baru</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Tambah Data Ikan</h5>

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

                    <!-- Form untuk menambah ikan baru -->
                    <form id="fish-form" action="{{ route('fish.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama Ikan</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="scientific_name">Nama Ilmiah</label>
                            <input type="text" class="form-control" id="scientific_name" name="scientific_name" placeholder="Masukkan nama ilmiah ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" class="form-control" id="category" name="category" placeholder="Masukkan kategori ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="origin">Asal</label>
                            <input type="text" class="form-control" id="origin" name="origin" placeholder="Masukkan asal ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="size">Ukuran</label>
                            <input type="text" class="form-control" id="size" name="size" placeholder="Masukkan ukuran ikan" required>
                        </div>

                        <div class="form-group">
                            <label for="characteristics">Karakteristik</label>
                            <textarea class="form-control" id="characteristics" name="characteristics" rows="4" placeholder="Masukkan karakteristik ikan" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="aquarium_size">Akuarium</label>
                            <input type="text" class="form-control" id="aquarium_size" name="aquarium_size" placeholder="Masukkan ukuran akuarium" required>
                        </div>

                        <div class="form-group">
                            <label for="temperature">Suhu Ideal</label>
                            <input type="text" class="form-control" id="temperature" name="temperature" placeholder="Masukkan suhu ideal" required>
                        </div>

                        <div class="form-group">
                            <label for="ph">pH Air</label>
                            <input type="text" class="form-control" id="ph" name="ph" placeholder="Masukkan pH air" required>
                        </div>

                        <div class="form-group">
                            <label for="salinity">Salinitas</label>
                            <input type="text" class="form-control" id="salinity" name="salinity" placeholder="Masukkan salinitas" required>
                        </div>

                        <div class="form-group">
                            <label for="lighting">Pencahayaan</label>
                            <input type="text" class="form-control" id="lighting" name="lighting" placeholder="Masukkan pencahayaan" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/fishpedia" class="btn btn-secondary">Kembali</a>
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
        $('#fish-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Clear the form
                    $('#fish-form')[0].reset();

                    // Display success message
                    $('#ajax-notification').html('<div class="alert alert-success">' + response.message + '</div>');

                    // Optionally, you can trigger a function to refresh the fish list
                    // fetchFishData(); // Uncomment this line if you implement the fetchFishData function
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
