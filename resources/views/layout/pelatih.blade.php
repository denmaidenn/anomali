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

                        <table id="pelatihTable" class="table center-aligned-table">
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

                        // Inisialisasi DataTable
                        $('#pelatihTable').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'Pelatih Table',
                                    exportOptions: {
                                        columns: ':visible:not(:last-child):not(:nth-last-child(2))' // Mengecualikan kolom "Details" dan "Manage"
                                    }
                                }
                            ]
                        });
                    } else {
                        $('#pelatih-table-body').append('<tr><td colspan="8" class="text-center">Tidak ada data pelatih.</td></tr>');
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

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
