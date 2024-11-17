    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="card-title mb-4">Pelatih Table</h5>
                        <a href="{{ route('pelatih.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <!-- Success or error message -->
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

                        <table class="table center-aligned-table">
                            <thead>
                                <tr class="text-primary">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Alamat</th>
                                    <th>Details</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="pelatih-table-body">
                                <!-- Pelatih data will be loaded here with AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for AJAX to fetch Pelatih data -->
    @section('pelatih_ajax')
    <script>
        loadPelatihData();

        function loadPelatihData() {
            $.ajax({
                url: '/api/pelatih', // pastikan API route yang benar
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#pelatih-table-body').empty();
                    if (response.data.length > 0) {
                        response.data.forEach(function(pelatih, index) {
                            $('#pelatih-table-body').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${pelatih.nama}</td>
                                    <td>${pelatih.email}</td>
                                    <td>${pelatih.no_telp}</td>
                                    <td>${pelatih.alamat}</td>
                                    <td><a href="/pelatih/${pelatih.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                    <td><a href="/pelatih/${pelatih.id}/edit" class="btn btn-primary btn-sm">Manage</a></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deletePelatih(${pelatih.id})">Remove</button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#pelatih-table-body').append('<tr><td colspan="7" class="text-center">Tidak ada data pelatih.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat memuat data pelatih.');
                }
            });
        }

        function deletePelatih(id) {
            if (confirm('Apakah Anda yakin menghapus data pelatih ini?')) {
                $.ajax({
                    url: `/api/pelatih/${id}`, // pastikan API route yang benar
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                        loadPelatihData(); // Reload data setelah penghapusan
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Terjadi kesalahan saat menghapus data pelatih.');
                    }
                });
            }
        }
    </script>
@endsection
