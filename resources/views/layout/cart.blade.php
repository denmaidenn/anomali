<div class="row mb-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">Cart User Table</h5>
                    <a href="#" class="btn btn-primary" onclick="loadUsersWithCarts()">Reload</a>
                </div>
                <div class="table-responsive">
                    <table class="table center-aligned-table">
                        <thead>
                            <tr class="text-primary">
                                <th>No</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Cart Items</th>
                                <th>Total Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="cart-users-table-body">
                            <!-- User cart data will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Load data automatically when the page is loaded
 
        loadUsersWithCarts();
    

    function loadUsersWithCarts() {
        $.ajax({
            url: '/api/cart',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#cart-users-table-body').empty();
                if (response.data.length > 0) {
                    response.data.forEach(function(user, index) {
                        let cartItems = user.cart && user.cart.items.length > 0 ? user.cart.items.map(item => `
                            <li>${item.produk_name} (x${item.quantity}) - Rp. ${item.subtotal}</li>
                        `).join('') : 'No items';

                        $('#cart-users-table-body').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td><ul>${cartItems}</ul></td>
                                <td>${user.cart ? user.cart.total_quantity : 0}</td>
                                <td>${user.cart ? user.cart.total_price : 0}</td>
                            </tr>
                        `);
                    });
                } else {
                    $('#cart-users-table-body').append('<tr><td colspan="6" class="text-center">No users with carts.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Failed to load data.');
            }
        });
    }
</script>

