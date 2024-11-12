<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center m-2">
                    <h5 class="card-title mb-0">Fishpedia Table</h5>
                    <div class="d-flex justify-content-center flex-grow-1 mx-4">
                        <div class="d-flex gap-2" style="width: 300px;">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                            <button class="btn btn-outline-primary search-btn" type="submit">
                                <i class="fa fa-search" style="height: 20px"></i>
                            </button>
                        </div>
                    </div>
                    <a href="{{ route('fishpedia.create') }}" class="btn btn-primary">Tambah</a>
                </div>

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

                <div class="table-responsive">
                    <table class="table center-aligned-table">
                        <thead>
                            <tr class="text-primary">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nama Ilmiah</th>
                                <th>Kategori</th>
                                <th>Asal</th>
                                <th>Ukuran</th>
                                <th>Karakteristik</th>
                                <th>Akuarium</th>
                                <th>Suhu Ideal</th>
                                <th>pH Air</th>
                                <th>Salinitas</th>
                                <th>Gambar</th>
                                <th>Details</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="fishpedia-table-body">
                            <!-- Data akan dimuat di sini menggunakan AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('fishpedia_ajax')
    <script>
        loadFishpediaData();

        // Fungsi untuk memuat data Fishpedia
        function loadFishpediaData() {
            $.ajax({
                url: '/api/fishpedia',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#fishpedia-table-body').empty();
                    if (response.success && response.data.length > 0) {
                        response.data.forEach(function(fish, index) {
                            $('#fishpedia-table-body').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${fish.nama}</td>
                                    <td>${fish.nama_ilmiah}</td>
                                    <td>${fish.kategori}</td>
                                    <td>${fish.asal}</td>
                                    <td>${fish.ukuran}</td>
                                    <td>${fish.karakteristik}</td>
                                    <td>${fish.akuarium}</td>
                                    <td>${fish.suhu_ideal} °C</td>
                                    <td>${fish.ph_air}</td>
                                    <td>${fish.salinitas}</td>
                                    <td>
                                        ${fish.gambar_ikan ? `<img src="/storage/${fish.gambar_ikan}" alt="Gambar Ikan" style="width: 50px; height: auto;">` : 'No Image'}
                                    </td>
                                   <td><a href="/fishpedia/${fish.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                    <td><a href="/fishpedia/${fish.id}/edit" class="btn btn-primary btn-sm">Manage</a></td>
                                    <td>
                                        <form action="/fishpedia/${fish.id}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#fishpedia-table-body').append('<tr><td colspan="15" class="text-center">No fish data available.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat memuat data Fishpedia.');
                }
            });
        }        
    </script>    
@endsection




