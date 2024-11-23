<div class="row mb-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">Checkout Table</h5>
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
<script>
    loadCheckoutData();

    function loadCheckoutData() {
        $.ajax({
            url: '/api/checkout-all', // API endpoint untuk data checkout
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#checkout-table-body').empty();
                if (response.data && response.data.length > 0) {
                    response.data.forEach(function(order, index) {
                        let itemsHtml = order.items.map(item => `
                            <li>
                                ${item.produk.nama_produk} (x${item.quantity}) - Rp${item.price}
                            </li>
                        `).join('');

                        let statusBadge = '';
                        if (order.status === 'paid') {
                            statusBadge = '<span class="badge bg-success">Paid</span>';
                        } else if (order.status === 'pending') {
                            statusBadge = '<span class="badge bg-warning">Pending</span>';
                        } else if (order.status === 'shipped') {
                            statusBadge = '<span class="badge bg-info">Shipped</span>';
                        } else if (order.status === 'completed') {
                            statusBadge = '<span class="badge bg-primary">Completed</span>';
                        } else {
                            statusBadge = '<span class="badge bg-secondary">' + order.status + '</span>';
                        }

                        $('#checkout-table-body').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${order.username}</td>
                                <td>${order.email}</td>
                                <td>Rp${order.total_price}</td>
                                <td>
                                    ${statusBadge}
                                </td>
                                <td>${new Date(order.created_at).toLocaleString()}</td>
                                <td>
                                    <ul>${itemsHtml}</ul>
                                </td>
                                <td>
                                    <button onclick="deleteCheckout(${order.id})" class="btn btn-danger btn-sm">Remove</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#checkout-table-body').append('<tr><td colspan="8" class="text-center">Tidak ada data checkout.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert('Terjadi kesalahan saat memuat data checkout.');
            }
        });
    }

    function editStatus(orderId, currentStatus) {
        let newStatus = prompt(`Ubah status (current: ${currentStatus}):`, currentStatus);

        // Jika pengguna tidak memasukkan status baru, batalkan
        if (!newStatus || newStatus === currentStatus) {
            return;
        }

        $.ajax({
            url: `/api/checkout/${orderId}/status`, // Endpoint API untuk update status
            type: 'PUT',
            data: { status: newStatus },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message || 'Status berhasil diperbarui.');
                loadCheckoutData();
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert('Terjadi kesalahan saat mengubah status.');
            }
        });
    }

    function deleteCheckout(id) {
        if (confirm('Apakah Anda yakin menghapus data checkout ini?')) {
            $.ajax({
                url: `/api/checkout/${id}`, // Endpoint API untuk hapus checkout
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Tampilkan pesan sukses
                    let successMessage = response.message || 'Data checkout berhasil dihapus.';
                    $('#checkout-table-body').prepend(`
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-success">${successMessage}</div>
                            </td>
                        </tr>
                    `);

                    // Muat ulang data tabel setelah penghapusan
                    loadCheckoutData();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat menghapus data checkout.');
                }
            });
        }
    }
</script>
@endsection
