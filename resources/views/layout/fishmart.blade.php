<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">Fishmart Table</h5>
                    <a href="{{ route('fishmart.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Nama Produk</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Gambar</th>
                                <th>Details</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="fishmart-table-body">
                            <!-- Data akan dimuat di sini menggunakan AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script AJAX untuk memuat data dari API -->
    @section('fishmart_ajax')
        <script>
            loadFishmartData();
            // Fungsi untuk memuat data Fishmart
            function loadFishmartData() {
                $.ajax({
                    url: '/api/fishmart',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#fishmart-table-body').empty();
                        if (response.success && Array.isArray(response.data) && response.data.length > 0) {
                            response.data.forEach(function(item, index) {
                                $('#fishmart-table-body').append(`
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.nama_produk}</td>
                                        <td>${item.deskripsi_produk}</td>
                                        <td>${item.kategori}</td>
                                        <td>${item.stok}</td>
                                        <td>Rp ${parseFloat(item.harga).toLocaleString()}</td>
                                        <td>
                                            ${item.gambar_produk ? `<img src="${item.gambar_produk}" alt="Gambar Produk" width="120px" height="auto">` : 'Tidak ada gambar'}
                                        </td>
                                        <td><a href="/fishmart/${item.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                        <td><a href="/fishmart/${item.id}/edit" class="btn btn-primary btn-sm">Manage</a></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteFishmart(${item.id})">Remove</button>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('#fishmart-table-body').append('<tr><td colspan="10" class="text-center">Tidak ada data Fishmart.</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Terjadi kesalahan saat memuat data produk.');
                    }
                });
            }

            function deleteFishmart(id) {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus data produk ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/api/fishmart/${id}`, // pastikan API route yang benar
                            type: 'DELETE',
                            dataType: 'json',
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                });
                                loadFishmartData(); // Reload data setelah penghapusan
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Terjadi kesalahan saat menghapus data produk.',
                                });
                            }
                        });
                    }
                });
            }
        </script>
    @endsection
