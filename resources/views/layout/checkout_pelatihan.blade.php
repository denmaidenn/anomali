<div class="row mb-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">Data Checkout</h5>
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
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Pelatihan</th>
                                <th>Pelatih</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Tanggal Checkout</th>
                            </tr>
                        </thead>
                        <tbody id="checkout-table-body">
                            <!-- Data checkout akan dimuat di sini melalui AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk AJAX -->
@section('checkoutpelatihan_ajax')
<script>
    $(document).ready(function () {
        loadCheckoutData();

        function loadCheckoutData() {
            $.ajax({
                url: '/api/getAllCheckouts', // Endpoint API
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('#checkout-table-body').empty();
                    if (response.success && response.data.length > 0) {
                        response.data.forEach(function (checkout, index) {
                            // Ambil data pelatihan, pelatih, dan user (FormUser)
                            let pelatihan = checkout.pelatihan ? checkout.pelatihan.judul : 'Tidak Diketahui';
                            let pelatih = checkout.pelatihan && checkout.pelatihan.user ? checkout.pelatihan.user.nama : 'Tidak Diketahui';
                            let namaUser = checkout.user ? checkout.user.name : 'Tidak Diketahui';
                            let emailUser = checkout.user ? checkout.user.email : 'Tidak Diketahui';
                            let totalHarga = checkout.total_harga ? `Rp${parseInt(checkout.total_harga).toLocaleString('id-ID')}` : 'Rp0';

                            // Badge status
                            let statusBadge = '';
                            if (checkout.status === 'pending') {
                                statusBadge = '<span class="badge bg-warning">Pending</span>';
                            } else if (checkout.status === 'paid') {
                                statusBadge = '<span class="badge bg-info">Completed</span>';
                            } else if (checkout.status === 'completed') {
                                statusBadge = '<span class="badge bg-success">Paid</span>';
                            } else if (checkout.status === 'canceled') {
                                statusBadge = '<span class="badge bg-danger">Canceled</span>';
                            } else {
                                statusBadge = `<span class="badge bg-secondary">${checkout.status}</span>`;
                            }


                            // Tambahkan baris ke tabel
                            $('#checkout-table-body').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${namaUser}</td>
                                    <td>${emailUser}</td>
                                    <td>${pelatihan}</td>
                                    <td>${pelatih}</td>
                                    <td>${totalHarga}</td>
                                    <td>${statusBadge}</td>
                                    <td>${new Date(checkout.created_at).toLocaleString('id-ID')}</td>
                                </tr>
                            `);
                        });
                    } else {
                        // Jika tidak ada data, tampilkan pesan kosong
                        $('#checkout-table-body').append('<tr><td colspan="8" class="text-center">Tidak ada data checkout.</td></tr>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat memuat data checkout.');
                }
            });
        }
    });
</script>
@endsection
