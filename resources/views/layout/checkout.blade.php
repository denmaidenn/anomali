<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">Checkout (Fishmart)</h5>
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Tanggal Checkout</th>
                                <th>Detail Items</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="checkout-table-body">
                            <!-- Data checkout akan dimuat di sini dengan AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk AJAX -->
@section('checkout_ajax')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    loadCheckoutDataFishmart();

    function loadCheckoutDataFishmart() {
        $.ajax({
            url: '/api/checkout-all', // Endpoint API untuk data checkout
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#checkout-table-body').empty();
                if (response.data && response.data.length > 0) {
                    response.data.forEach(function (order, index) {
                        let itemsHtml = order.items.map(item => `
                            <li>
                                ${item.produk.nama_produk} (x${item.quantity}) - Rp${parseInt(item.price).toLocaleString('id-ID')}
                            </li>
                        `).join('');

                        // Badge status
                        let statusBadge = '';
                        switch (order.status) {
                            case 'paid':
                                statusBadge = '<span class="badge bg-success">Paid</span>';
                                break;
                            case 'pending':
                                statusBadge = '<span class="badge bg-warning">Pending</span>';
                                break;
                            case 'shipped':
                                statusBadge = '<span class="badge bg-info">Shipped</span>';
                                break;
                            case 'completed':
                                statusBadge = '<span class="badge bg-primary">Completed</span>';
                                break;
                            case 'canceled':
                                statusBadge = '<span class="badge bg-danger">Canceled</span>';
                                break;
                            default:
                                statusBadge = `<span class="badge bg-secondary">${order.status}</span>`;
                        }

                        // Tombol Aksi
                        let actionButtons = `
                            <div class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#actions-menu-${order.id}" aria-expanded="false" aria-controls="actions-menu-${order.id}">
                                    <span class="menu-title">Status <i class="fa fa-sort-down"></i></span>
                                </a>
                                <div class="collapse" id="actions-menu-${order.id}">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item mb-2">
                                            <a class="nav-link btn-success text-white update-status-fishmart" href="#" data-id="${order.id}" data-status="paid" style="border-radius: 5px; text-align: center;">
                                                Sudah Bayar
                                            </a>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <a class="nav-link btn-warning text-white update-status-fishmart" href="#" data-id="${order.id}" data-status="pending" style="border-radius: 5px; text-align: center;">
                                                Pending
                                            </a>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <a class="nav-link btn-info text-white update-status-fishmart" href="#" data-id="${order.id}" data-status="shipped" style="border-radius: 5px; text-align: center;">
                                                Dikirim
                                            </a>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <a class="nav-link btn-danger text-white delete-checkout-fishmart" href="#" data-id="${order.id}" style="border-radius: 5px; text-align: center;">
                                                Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        `;

                        // Tambahkan baris ke tabel
                        $('#checkout-table-body').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${order.username}</td>
                                <td>${order.email}</td>
                                <td>Rp${parseInt(order.total_price).toLocaleString('id-ID')}</td>
                                <td>${statusBadge}</td>
                                <td>${new Date(order.created_at).toLocaleString('id-ID')}</td>
                                <td><ul>${itemsHtml}</ul></td>
                                <td>${actionButtons}</td>
                            </tr>
                        `);
                    });

                    // Tambahkan event listener untuk update status
                    $('.update-status-fishmart').off('click').on('click', function (e) {
                        e.preventDefault();
                        let id = $(this).data('id');
                        let status = $(this).data('status');
                        updateCheckoutStatusFishmart(id, status);
                    });

                    // Tambahkan event listener untuk delete
                    $('.delete-checkout-fishmart').off('click').on('click', function (e) {
                        e.preventDefault();
                        let id = $(this).data('id');
                        deleteCheckoutFishmart(id);
                    });
                } else {
                    $('#checkout-table-body').append('<tr><td colspan="8" class="text-center">Tidak ada data checkout.</td></tr>');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                Swal.fire('Terjadi kesalahan', 'Kesalahan saat memuat data checkout.', 'error');
            }
        });
    }

    function updateCheckoutStatusFishmart(orderId, status) {
        $.ajax({
            url: `/api/order/${orderId}/status`, // Endpoint API untuk update status
            type: 'PUT',
            data: { status: status },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                console.log(response);
                if (response.success !== undefined && response.success) {
                    // Tampilkan alert untuk semua status
                    Swal.fire('Sukses', response.message || 'Status berhasil diperbarui.', 'success');
                    loadCheckoutDataFishmart(); // Refresh data tabel
                } else {
                    Swal.fire('Gagal', 'Gagal mengupdate status checkout.', 'error');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                Swal.fire('Gagal', 'Gagal mengupdate status checkout.', 'error');
            }
        });
    }

    function deleteCheckoutFishmart(orderId) {
        if (confirm('Apakah Anda yakin ingin menghapus checkout ini?')) {
            $.ajax({
                url: `/api/checkout/${orderId}`, // Endpoint API untuk delete
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    Swal.fire('Sukses', response.message || 'Data checkout berhasil dihapus.', 'success');
                    loadCheckoutDataFishmart(); // Refresh data tabel
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    Swal.fire('Gagal', 'Gagal menghapus data checkout.', 'error');
                }
            });
        }
    }
</script>



@endsection
