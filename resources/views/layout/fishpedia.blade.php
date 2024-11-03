<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">Fishpedia Table</h5>
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
                                <th>Asal</th>
                                <th>Jenis</th>
                                <th>Deskripsi</th>
                                <th>Harga Pasar</th>
                                <th>Gambar</th>
                                <th>Manage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fish as $fishes)
                                <tr>
                                    <td>{{ $fishes->id }}</td>
                                    <td>{{ $fishes->nama }}</td>
                                    <td>{{ $fishes->asal }}</td>
                                    <td>{{ $fishes->jenis }}</td>
                                    <td>{{ $fishes->deskripsi }}</td>
                                    <td>{{ number_format($fishes->harga_pasar, 2) }}</td>
                                    <td>
                                        @if($fishes->gambar_ikan)
                                            <img src="{{ asset('storage/'.$fishes->gambar_ikan) }}" alt="Gambar Ikan" style="width: 50px; height: auto;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('fishpedia.edit', $fishes->id) }}" class="btn btn-primary btn-sm">Manage</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('fishpedia.delete', $fishes->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
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
