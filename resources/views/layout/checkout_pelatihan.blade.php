<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">Checkout (Pelatihan)</h5>
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
                        <tbody id="checkout-table-pelatihan-body">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Tambahkan ini untuk menggunakan Sweet Alert -->
<script>
    loadCheckoutDataPelatihan();

    function loadCheckoutDataPelatihan() {
        $.ajax({
            url: '/api/getAllCheckouts', // Endpoint API untuk mendapatkan data checkout
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('#checkout-table-pelatihan-body').empty();
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
                        } else if (checkout.status === 'completed') {
                            statusBadge = '<span class="badge bg-info">Completed</span>';
                        } else if (checkout.status === 'shipped') {
                            statusBadge = '<span class="badge bg-primary">Shipped</span>';
                        } else if (checkout.status === 'paid') {
                            statusBadge = '<span class="badge bg-success">Paid</span>';
                        } else if (checkout.status === 'canceled') {
                            statusBadge = '<span class="badge bg-danger">Canceled</span>';
                        } else {
                            statusBadge = `<span class="badge bg-secondary">${checkout.status}</span>`;
                        }

                        // Tombol Aksi (Dropdown untuk Update dan Delete)
                        let actionButtons = `
                            <div class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#actions-menu-pelatihan-${checkout.id}" aria-expanded="false" aria-controls="actions-menu-pelatihan-${checkout.id}">
                                    <span class="menu-title">Status <i class="fa fa-sort-down"></i></span>
                                </a>
                                <div class="collapse" id="actions-menu-pelatihan-${checkout.id}">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item mb-2">
                                            <a class="nav-link btn-success text-white update-status-pelatihan" href="#" data-id="${checkout.id}" data-status="paid" style="border-radius: 5px; text-align: center;">
                                                Sudah Bayar
                                            </a>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <a class="nav-link btn-warning text-white update-status-pelatihan" href="#" data-id="${checkout.id}" data-status="canceled" style="border-radius: 5px; text-align: center;">
                                                Batalkan
                                            </a>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <a class="nav-link btn-danger text-white delete-checkout-pelatihan" href="#" data-id="${checkout.id}" style="border-radius: 5px; text-align: center;">
                                                Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        `;

                        // Tambahkan baris ke tabel
                        $('#checkout-table-pelatihan-body').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${namaUser}</td>
                                <td>${emailUser}</td>
                                <td>${pelatihan}</td>
                                <td>${pelatih}</td>
                                <td>${totalHarga}</td>
                                <td>${statusBadge}</td>
                                <td>${new Date(checkout.created_at).toLocaleString('id-ID')}</td>
                                <td>${actionButtons}</td>
                            </tr>
                        `);
                    });

                    // Tambahkan event listener untuk update status
                    $('.update-status-pelatihan').on('click', function (e) {
                        e.preventDefault();
                        let id = $(this).data('id');
                        let status = $(this).data('status');
                        updateCheckoutStatus(id, status);
                    });

                    // Tambahkan event listener untuk delete
                    $('.delete-checkout-pelatihan').on('click', function (e) {
                        e.preventDefault();
                        let id = $(this).data('id');
                        deleteCheckout(id);
                    });
                } else {
                    // Jika tidak ada data, tampilkan pesan kosong
                    $('#checkout-table-pelatihan-body').append('<tr><td colspan="9" class="text-center">Tidak ada data checkout.</td></tr>');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memuat data checkout.',
                });
            }
        });
    }

    function updateCheckoutStatus(order_id, status) {
        $.ajax({
            url: `/api/orders/${order_id}/status`, // Endpoint API untuk update status
            type: 'PUT',
            data: { status: status },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, // Untuk Laravel
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message,
                }).then(() => {
                    loadCheckoutDataPelatihan(); // Refresh data tabel
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal mengupdate status checkout.',
                });
            }
        });
    }

    function deleteCheckout(order_id) {
        if (confirm('Apakah Anda yakin ingin menghapus checkout ini?')) {
            $.ajax({
                url: `/api/orders/${order_id}`, // Endpoint API untuk delete
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, // Untuk Laravel
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                    }).then(() => {
                        loadCheckoutDataPelatihan(); // Refresh data tabel
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal menghapus data checkout.',
                    });
                }
            });
        }
    }
</script>

@endsection
