<div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between m-2">
                            <h5 class="card-title mb-4">Tabel Pelatihan</h5>
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
                                        <th>Video Pelatihan</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pelatihan as $pelatihans)
                                        <tr>
                                            <td>{{ $pelatihans->id }}</td>
                                            <td>{{ $pelatihans->id_user }}</td>
                                            <td>{{ $pelatihans->video_pelatihan }}</td>
                                            <td>{{ $pelatihans->deskripsi }}</td>
                                            <td>Rp {{ number_format($pelatihans->harga, 2) }}</td>
                                            <td>
                                                <a href="{{ route('pelatihan.edit', $pelatihans->id) }}" class="btn btn-primary btn-sm">Manage</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('pelatihan.destroy', $pelatihans->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
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