@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Dashboard</h3>

    @if (session('success_login'))
        <div class="alert alert-success">
            {{ session('success_login') }}
        </div>
    @endif
    @if (session('error_login'))
        <div class="alert alert-danger">
            {{ session('error_login') }}
        </div>
    @endif

    <!-- Tabel User -->
    @include('layout.user')

    <!-- Tabel Fishpedia -->
    @include('layout.fishpedia')

    <!-- Tabel Pelatihan -->
    @include('layout.pelatihan')

    <!-- Tabel Fishmart -->
    @include('layout.fishmart')

    <!-- Tabel Feedback -->
    @include('layout.feedback')
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Load semua data saat halaman selesai dimuat
        // GET
        loadUserData();
        loadFishpediaData();
        loadPelatihanData();
        loadFishmartData();
        loadFeedbackData();

        // Fungsi untuk memuat data pengguna
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
                                    <td>${user.password}</td>
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
                                    <td>${fish.pencahayaan}</td>
                                    <td>
                                        ${fish.gambar_ikan ? `<img src="/storage/${fish.gambar_ikan}" alt="Gambar Ikan" style="width: 50px; height: auto;">` : 'No Image'}
                                    </td>
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
                                    <td><a href="/pelatihan/${item.id}/edit" class="btn btn-primary btn-sm">Manage</a></td>
                                    <td>
                                        <form action="/pelatihan/${item.id}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
                                        ${item.gambar_produk ? `<img src="${item.gambar_produk}" alt="Gambar Produk" width="50px" height="auto">` : 'Tidak ada gambar'}
                                    </td>
                                    <td><a href="/fishmart/${item.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                    <td><a href="/fishmart/${item.id}/edit" class="btn btn-primary btn-sm">Manage</a></td>
                                    <td>
                                        <form action="/fishmart/${item.id}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#fishmart-table-body').append('<tr><td colspan="10" class="text-center">No product data available.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat memuat data produk.');
                }
            });
        }

        // Fungsi untuk memuat data Feedback
        function loadFeedbackData() {
            $.ajax({
                url: '/api/feedback',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#feedback-table-body').empty();
                    if (response.data.length > 0) {
                        response.data.forEach(function(feedback, index) {
                            $('#feedback-table-body').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${feedback.user ? feedback.user.name : 'Unknown User'}</td>
                                    <td>${feedback.komentar}</td>
                                    <td><a href="/feedback/${feedback.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                    <td><a href="/feedback/${feedback.id}/edit" class="btn btn-primary btn-sm">Manage</a></td>
                                    <td>
                                        <form action="/feedback/${feedback.id}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#feedback-table-body').append('<tr><td colspan="4" class="text-center">Tidak ada data feedback.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat memuat data feedback.');
                }
            });
        }
    });
</script>
@endsection
