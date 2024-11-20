@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4 font-weight-bold">Detail Fishmart</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0" id="product-name">Loading...</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Nama Produk:</div>
                        <div class="col-md-8" id="product-name-display">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Kategori:</div>
                        <div class="col-md-8" id="category">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Deskripsi:</div>
                        <div class="col-md-8" id="description">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Stok:</div>
                        <div class="col-md-8" id="stock">Loading...</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Harga:</div>
                        <div class="col-md-8" id="price">Loading...</div>
                    </div>
                    <!-- Gambar Produk -->
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Gambar Produk:</div>
                        <div class="col-md-8" id="product-image">
                            <p class="text-muted">Loading...</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('fishmart.index') }}" class="btn btn-secondary me-2">Kembali ke Daftar Fishmart</a>
                        <a href="{{ route('fishmart.edit', $produk->id) }}" class="btn btn-primary">Edit Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const productId = {{ $produk->id }}; // ID produk dari server-side.

    // Fetch data produk untuk mengisi form
    window.onload = function() {
        fetch(`/api/fishmart/${productId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("API response data:", data);
                    const produk = data.data;

                    // Update the product name and other details
                    document.getElementById('product-name').textContent = produk.nama_produk;
                    document.getElementById('product-name-display').textContent = produk.nama_produk;
                    document.getElementById('category').textContent = produk.kategori || 'Tidak ada kategori';
                    document.getElementById('description').textContent = produk.deskripsi_produk || 'Deskripsi tidak tersedia';
                    document.getElementById('stock').textContent = produk.stok || 'Stok tidak diketahui';
                    document.getElementById('price').textContent = produk.harga ? `Rp ${produk.harga}` : 'Harga tidak diketahui';

                    const productImageElement = document.getElementById('product-image');
                    if (produk.gambar_produk) {
                        const imgElement = document.createElement("img");
                        imgElement.src = produk.gambar_produk;
                        imgElement.alt = "Gambar Produk";
                        imgElement.classList.add("img-fluid", "rounded", "shadow-sm");
                        imgElement.width = 200;
                        productImageElement.innerHTML = '';  // Clear previous content if any
                        productImageElement.appendChild(imgElement);
                    } else {
                        productImageElement.innerHTML = '<p class="text-muted">Tidak ada gambar.</p>';
                    }
                } else {
                    console.error('Produk tidak ditemukan');
                }
            })
            .catch(error => {
                console.error('Error fetching produk:', error);
            });
    };
</script>
@endsection
