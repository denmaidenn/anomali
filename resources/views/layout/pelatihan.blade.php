        <div class="row mb-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between m-2">
                            <h5 class="card-title mb-4">Tabel Pelatihan</h5>
                            <div class="d-flex justify-content-center flex-grow-1 mx-4">
                                <div class="d-flex gap-2" style="width: 300px;">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                                    <button class="btn btn-outline-primary search-btn" type="button" onclick="searchPelatihan()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="{{ route('pelatihan.create') }}" class="btn btn-primary">Tambah</a>
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
                                        <th>Nama User</th>
                                        <th>Video Pelatihan</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Manage</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody id="pelatihan-table-body">
                                    <!-- Data akan dimuat di sini menggunakan AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

