<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center m-2">
                    <h5 class="card-title mb-0">Fishpedia Table</h5>
                    <div class="d-flex justify-content-center flex-grow-1 mx-4">
                        <div class="d-flex gap-2" style="width: 300px;">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                            <button class="btn btn-outline-primary search-btn" type="submit">
                                <i class="fa fa-search" style="height: 20px"></i>
                            </button>
                        </div>
                    </div>
                    <a href="{{ route('fishpedia.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Nama</th>
                                <th>Nama Ilmiah</th>
                                <th>Kategori</th>
                                <th>Asal</th>
                                <th>Ukuran</th>
                                <th>Karakteristik</th>
                                <th>Akuarium</th>
                                <th>Suhu Ideal</th>
                                <th>pH Air</th>
                                <th>Salinitas</th>
                                <th>Pencahayaan</th>
                                <th>Gambar</th>
                                <th>Manage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="fishpedia-table-body">
                            <!-- Data akan dimuat di sini menggunakan AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


