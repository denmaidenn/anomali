
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
                                    <th>Manage</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fish as $fishes)
                                    <tr>
                                        <td>{{ $fishes->id }}</td>
                                        <td>{{ $fishes->name }}</td>
                                        <td>{{ $fishes->scientific_name }}</td>
                                        <td>{{ $fishes->category }}</td>
                                        <td>{{ $fishes->origin }}</td>
                                        <td>{{ $fishes->size }}</td>
                                        <td>{{ $fishes->characteristics }}</td>
                                        <td>{{ $fishes->aquarium_size }}</td>
                                        <td>{{ $fishes->temperature }}</td>
                                        <td>{{ $fishes->ph }}</td>
                                        <td>{{ $fishes->salinity }}</td>
                                        <td>{{ $fishes->lighting }}</td>
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


