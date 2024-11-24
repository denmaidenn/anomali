<div class="row mb-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">Mobile User Table</h5>
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="table-responsive">
                    <!-- Pesan sukses atau error -->
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

                    <table id="userTable" class="table center-aligned-table">
                        <thead>
                            <tr class="text-primary">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Gambar Profil</th>
                                <th>Details</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="user-table-body">
                            <!-- Data pengguna akan dimuat di sini dengan AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk AJAX -->

@section('user_ajax')
<script>
    loadUserData();

    function loadUserData() {
        $.ajax({
            url: '/api/formuser',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#user-table-body').empty();
                if (response.length > 0) {
                    response.forEach(function(user, index) {
                        $('#user-table-body').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.username}</td>
                                <td>${user.no_telp ? user.no_telp : 'Tidak tersedia'}</td>
                                <td>${user.alamat ? user.alamat : 'Tidak tersedia'}</td>
                                <td>
                                    ${user.gambar_profile 
                                        ? `<img src="/storage/${user.gambar_profile}" alt="Profile Picture" width="50" height="50" />` 
                                        : 'Tidak ada gambar'
                                    }
                                </td>
                                <td><a href="/user/${user.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                <td><a href="/user/${user.id}/edituser" class="btn btn-primary btn-sm">Manage</a></td>
                                <td>
                                    <button onclick="deleteUser(${user.id})" class="btn btn-danger btn-sm">Remove</button>
                                </td>
                            </tr>
                        `);
                    });

                    // Inisialisasi DataTable
                    $('#userTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'User Table',
                                exportOptions: {
                                    columns: ':visible:not(:last-child):not(:nth-last-child(2))' // Mengecualikan kolom "Details" dan "Manage"
                                }
                            }
                        ]
                    });
                } else {
                    $('#user-table-body').append('<tr><td colspan="10" class="text-center">Tidak ada data pengguna.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert('Terjadi kesalahan saat memuat data pengguna.');
            }
        });
    }

    function deleteUser(id) {
        if (confirm('Apakah Anda yakin menghapus data ini?')) {
            $.ajax({
                url: `/api/formuser/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Tampilkan pesan sukses
                    let successMessage = response.message || 'Pengguna berhasil dihapus.';
                    $('#user-table-body').prepend(`
                        <tr>
                            <td colspan="10">
                                <div class="alert alert-success">${successMessage}</div>
                            </td>
                        </tr>
                    `);

                    // Muat ulang data tabel setelah penghapusan
                    loadUserData();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat menghapus pengguna.');
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
