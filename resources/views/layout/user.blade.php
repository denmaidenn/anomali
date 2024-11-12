    
    <div class="row mb-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between m-2">
                            <h5 class="card-title mb-4">User Data Table</h5>
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

                            <table class="table center-aligned-table">
                                <thead>
                                    <tr class="text-primary">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
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
                                    <td><a href="/user/${user.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                    <td><a href="/user/${user.id}/edituser" class="btn btn-primary btn-sm">Manage</a></td>
                                    <td>
                                        <form action="/user/${user.id}/deleteuser" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#user-table-body').append('<tr><td colspan="7" class="text-center">Tidak ada data pengguna.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat memuat data pengguna.');
                }
            });
        }        
    </script>
    @endsection


