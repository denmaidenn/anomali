@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Forms</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Edit Produk Fishmart</h2>
                    <form id="editFishForm">
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" id="nama_produk" name="nama_produk" class="form-control">
                            <small id="error_nama_produk" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_produk">Deskripsi Produk</label>
                            <textarea id="deskripsi_produk" name="deskripsi_produk" class="form-control"></textarea>
                            <small id="error_deskripsi_produk" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select id="kategori" name="kategori" class="form-control">
                                <option value="Filter Air">Filter Air</option>
                                <option value="Pakan">Pakan</option>
                                <option value="Tanaman Hias">Tanaman Hias</option>
                                <option value="Batu Coral">Batu Coral</option>
                                <option value="Aquascape">Aquascape</option>
                            </select>
                            <small id="error_kategori" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" id="stok" name="stok" class="form-control">
                            <small id="error_stok" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" id="harga" name="harga" class="form-control">
                            <small id="error_harga" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="gambar_produk">Gambar Produk</label>
                            <input type="file" id="gambar_produk" name="gambar_produk" class="form-control">
                            <div id="gambarContainer" class="mt-2"></div>
                        </div>

                        <button id="submitButton" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const productId = {{ $produk->id }}; // ID produk dari server-side.

    // Fetch data produk untuk mengisi form
    window.onload = function() {
        fetch(`/api/fishmart/${productId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data);
                    const produk = data.data;

                    document.getElementById('nama_produk').value = produk.nama_produk;
                    document.getElementById('deskripsi_produk').value = produk.deskripsi_produk;
                    document.getElementById('kategori').value = produk.kategori;
                    document.getElementById('stok').value = produk.stok;
                    document.getElementById('harga').value = produk.harga;

                    const gambarContainer = document.getElementById('gambarContainer');
                    if (produk.gambar_produk) {
                        const imgElement = document.createElement("img");
                        imgElement.src = produk.gambar_produk;
                        imgElement.alt = "Gambar Produk";
                        imgElement.id = "currentImage";
                        imgElement.classList.add("img-fluid", "rounded", "shadow-sm");
                        imgElement.width = 200;
                        gambarContainer.appendChild(imgElement);
                    }
                } else {
                    console.error('Produk tidak ditemukan');
                }
            })
            .catch(error => {
                console.error('Error fetching produk:', error);
            });
    };

    // Submit form untuk update produk
    document.getElementById('submitButton').addEventListener('click', function(e) {
        e.preventDefault();

        const formData = new FormData(document.getElementById('editFishForm'));
        formData.append('_method', 'PUT'); // Laravel mendukung metode PUT via form

        fetch(`/api/fishmart/${productId}`, {
            method: 'POST', // Workaround untuk PUT
            headers: {
                'Authorization': `Bearer yourActualTokenHere`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => Promise.reject(errorData));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message);
                                    // Update or create image element
                const imgElement = document.getElementById("currentImage") || document.createElement("img");
                imgElement.src = `/storage/${data.data.gambar_produk}`;
                imgElement.alt = "Gambar Produk";
                imgElement.id = "currentImage";
                imgElement.classList.add("img-fluid", "rounded", "shadow-sm");
                imgElement.width = 200;
                document.getElementById('gambarContainer').appendChild(imgElement);
                window.location.href = "{{ route('fishmart.index') }}";
            } else {
                alert('Gagal memperbarui data produk');
            }
        })
        .catch(error => {
            if (error && error.errors) {
                Object.keys(error.errors).forEach(key => {
                    const errorElement = document.getElementById('error_' + key);
                    if (errorElement) {
                        errorElement.innerText = error.errors[key].join(', ');
                    }
                });
            }
            console.error('Error updating produk:', error);
        });
    });
</script>
@endsection
