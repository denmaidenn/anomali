        <div class="row mb-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between m-2">
                            <h5 class="card-title mb-4">Pelatihan Table</h5>
                            <div class="d-flex justify-content-center flex-grow-1 mx-4">
                                <div class="d-flex gap-2" style="width: 300px;">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                                    <button class="btn btn-outline-primary search-btn" type="button" onclick="searchPelatihan()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="{{ route('pelatihan.create') }}" class="btn btn-primary">Tambah</a>
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
                                        <th>User ID</th>
                                        <th>Nama User</th>
                                        <th>Video Pelatihan</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Details</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="pelatihan-table-body">
                                    <!-- Data akan dimuat di sini menggunakan AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @section('pelatihan_ajax')
            <script>
                loadPelatihanData();
                // Fungsi untuk memuat data Pelatihan
                function loadPelatihanData() {
                    $.ajax({
                        url: '/api/pelatihan',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            $('#pelatihan-table-body').empty();
                            if (response.success && Array.isArray(response.data) && response.data.length > 0) {
                                response.data.forEach(function(item, index) {
                                    $('#pelatihan-table-body').append(`
                                        <tr>
                                            <td>${index + 1}</td>
                                            <td>${item.id_user}</td>
                                            <td>${item.user.name}</td>
                                            <td><a href="${item.video_pelatihan}" target="_blank">Lihat Video</a></td>
                                            <td>${item.deskripsi_pelatihan}</td>
                                            <td>Rp ${parseFloat(item.harga).toLocaleString()}</td>
                                            <td><a href="/pelatihan/${item.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                            <td><a href="/pelatihan/${item.id}/edit" class="btn btn-primary btn-sm">Manage</a></td>
                                            <td>
                                                <form action="/pelatihan/${item.id}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    `);
                                });
                            } else {
                                $('#pelatihan-table-body').append('<tr><td colspan="8" class="text-center">Tidak ada data pelatihan.</td></tr>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            alert('Terjadi kesalahan saat memuat data pelatihan.');
                        }
                    });
                }             
            </script>
        @endsection

