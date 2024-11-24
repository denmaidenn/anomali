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
                    <div class="d-flex gap-2">
                        <!-- <button id="printFishpediaTable" class="btn btn-secondary me-2">Print PDF</button> -->
                        <a href="{{ route('fishpedia.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
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
                    <table id="fishpediaTable" class="table center-aligned-table">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            <tr id="fish-row-${fish.id}">
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
                                    <button class="btn btn-danger btn-sm" onclick="deleteFishpedia(${fish.id})">Remove</button>
                                </td>
                            </tr>
                        `);
                    });

                    // Inisialisasi DataTable
                    let table = new DataTable('#fishpediaTable', {
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'Fishpedia Table',
                                exportOptions: {
                                    columns: ':visible:not(:last-child):not(:nth-last-child(2)):not(:nth-last-child(3))'
                                }
                            }
                        ]
                    });
                } else {
                    $('#fishpedia-table-body').append('<tr><td colspan="15" class="text-center">Tidak ada data Fishpedia.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Terjadi kesalahan saat memuat data Fishpedia.');
            }
        });
    }

    // Fungsi untuk menghapus data Fishpedia
    function deleteFishpedia(fishId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/api/fishpedia/${fishId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Terhapus!',
                                'Data ikan berhasil dihapus.',
                                'success'
                            );
                            $(`#fish-row-${fishId}`).remove(); // Hapus baris tabel secara langsung
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Gagal menghapus data.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data Fishpedia.',
                            'error'
                        );
                    }
                });
            }
        });
    }
    
</script>

@endsection




