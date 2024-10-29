@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Daftar Pelatihan</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="card-title mb-4">Tabel Pelatihan</h5>
                        <a href="{{ route('pelatihan.create') }}" class="btn btn-primary">Tambah Pelatihan</a>
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
                                    <th>Video Pelatihan</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Manage</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pelatihan as $pelatihans)
                                    <tr>
                                        <td>{{ $pelatihans->id}}</td>
                                        <td>{{ $pelatihans->user_id }}</td>
                                        <td>{{ $pelatihans->video_pelatihan }}</td>
                                        <td>{{ $pelatihans->deskripsi_pelatihan }}</td>
                                        <td>{{ number_format($pelatihans->harga, 2) }}</td>
                                        <td>
                                            <a href="{{ route('pelatihan.show', $pelatihans->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('pelatihan.edit', $pelatihans->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('pelatihan.destroy', $pelatihans->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section to display pelatihan data from API -->
    <h3 class="page-heading mb-4">Data Pelatihan (API)</h3>
    <div id="pelatihan-data" class="mb-4"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/api/pelatihan', // Adjust the URL if needed
            method: 'GET',
            success: function(data) {
                let pelatihanHtml = '<ul class="list-group">';
                data.forEach(function(pelatihan) {
                    pelatihanHtml += '<li class="list-group-item">' + pelatihan.deskripsi_pelatihan + ' (Harga: ' + pelatihan.harga + ')</li>';
                });
                pelatihanHtml += '</ul>';
                $('#pelatihan-data').html(pelatihanHtml);
            },
            error: function(err) {
                console.error('Error fetching pelatihan data:', err);
                $('#pelatihan-data').html('<p class="text-danger">Error fetching data</p>');
            }
        });
    });
</script>
@endsection
@section('scripts')
<script>
document.addEventListener('searchResults', function(e) {
    const results = e.detail.results;
    const tbody = document.querySelector('tbody');

    if (results.length > 0) {
        tbody.innerHTML = results.map(item => `
            <tr>
                <td>${item.id_transaksi}</td>
                <td>${item.id_produk}</td>
                <td>${item.nama_produk}</td>
                <td>${item.deskripsi_produk}</td>
                <td>
                    <img src="${item.gambar_produk}" alt="${item.nama_produk}" class="table-image">
                </td>
                <td>${item.jumlah_produk}</td>
                <td>Rp ${item.harga}</td>
                <td>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail-${item.id_transaksi}">
                        <i class="fa fa-eye"></i> Detail
                    </button>
                </td>
            </tr>
        `).join('');
    } else {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="text-center">No results found</td>
            </tr>
        `;
    }
});
</script>
@endsection
