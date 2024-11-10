<div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="card-title mb-4">Tabel Fishmart</h5>
                        <a href="{{ route('fishmart.create') }}" class="btn btn-primary">Tambah</a>
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
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Lihat</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produk as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>{{ $item->deskripsi_produk }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>Rp {{ number_format($item->harga, 2) }}</td>
                                        <td>
                                            @if($item->gambar_produk)
                                                <img src="{{ asset('storage/' . $item->gambar_produk) }}" alt="Gambar Produk" width="50px" height="auto">
                                            @else
                                                Tidak ada gambar
                                            @endif
                                        </td>
                                        <td>
                                            <a  href="{{ route('fishmart.show', $item->id) }}" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail-3">
                                                <i class="fa fa-eye"></i> Detail
                                            </a>
                                        </td>
                                        <td>
                                             <a href="{{ route('fishmart.edit', $item->id) }}" class="btn btn-primary btn-sm">Manage</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('fishmart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
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