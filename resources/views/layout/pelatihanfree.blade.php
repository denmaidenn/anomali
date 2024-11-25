<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center m-2">
                    <h5 class="card-title mb-0">Pelatihan Table (Free)</h5>
                    <a href="{{ route('pelatihanfree.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Pelatih</th>
                                <th>Judul Pelatihan</th>
                                <th>Video Pelatihan</th>
                                <th>Deskripsi</th>
                                <th>Gambar Pelatihan</th>
                                <th>Details</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="pelatihanfree-table-body">
                            <!-- Data akan dimuat di sini menggunakan AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('pelatihanfree_ajax')
    <script>
        loadPelatihanData();

        // Fungsi untuk memuat data Pelatihan
        function loadPelatihanData() {
            $.ajax({
                url: '/api/pelatihanfree',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#pelatihanfree-table-body').empty(); // Clear the table body
                    if (response.success && response.data.length > 0) {
                        response.data.forEach(function(item, index) {
                            $('#pelatihanfree-table-body').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.user ? item.user.nama : 'No Pelatih'}</td>
                                    <td>${item.judul}</td>
                                    <td><a href="/storage/${item.video_pelatihan}" target="_blank">Lihat Video</a></td>
                                    <td>${item.deskripsi_pelatihan}</td>
                                    <td>
                                        ${item.gambar_pelatihan ? `<img src="/storage/${item.gambar_pelatihan}" alt="Gambar Pelatihan" style="width: 100px; height: auto;">` : 'No Image'}
                                    </td>
                                    <td><a href="/pelatihanfree/${item.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                    <td><a href="/pelatihanfree/${item.id}/edit" class="btn btn-primary btn-sm">Manage</a></td>
                                    <td>
                                        <form action="/pelatihanfree/${item.id}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#pelatihanfree-table-body').append('<tr><td colspan="10" class="text-center">Tidak ada data pelatihan.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat memuat data pelatihan.');
                }
            });
        }

        // Fungsi pencarian untuk filter berdasarkan input
        function searchPelatihan() {
            const searchTerm = $('#searchInput').val().toLowerCase();
            $('#pelatihanfree-table-body tr').each(function() {
                const rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchTerm) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    </script>
@endsection
