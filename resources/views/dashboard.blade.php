@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Dashboard</h3>

    @if (session('success_login'))
      <div class="alert alert-success">
        {{ session('success_login') }}
      </div>
    @endif
    @if (session('error_login'))
      <div class="alert alert-danger">
      {{ session('error_login') }}
      </div>
    @endif


          <!-- User Data Table -->
          <div class="row mb-4">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">User Data Table</h5>
                    <a href="/formuser" class="btn btn-primary ">Tambah</a>
                  </div>
                  <div class="table-responsive">

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
                          <th> No</th>
                          <th>Nama</th>
                          <th> Email</th>
                          <th> Prodi</th>
                          <th> Kelas</th>
                          <th> Jenis Kelamin </th>
                          <th></th>
                          <th></th>

                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $mahasiswa)
                        <tr class="">
                          <td>{{ $mahasiswa->id}}</td>
                          <td>{{ $mahasiswa-> name }}</td>
                          <td>{{ $mahasiswa-> email }}</td>
                          <td>{{ $mahasiswa-> prodi }}</td>
                          <td>{{ $mahasiswa-> kelas }}</td>
                          <td>{{ $mahasiswa-> jenis_kelamin }}</td>
                          <div>
                            <td>
                              <a href="{{ route('manageuser', $mahasiswa -> id) }}"  class="btn btn-primary btn-sm">Manage</a>
                            </td>
                            <td>

                              <form action="{{ route('deleteuser', $mahasiswa -> id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" >
                                @csrf
                                @method('DELETE')

                                  <button  type="submit" class="btn btn-danger btn-sm">Remove</button>


                              </form>
                            </td>
                          </div>

                        </tr>


                      @endforeach


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Fishpedia Table -->
          <div class="row mb-4">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">Fishpedia Table</h5>
                    <a href="/tambahikan" class="btn btn-primary ">Tambah</a>
                  </div>
                  <div class="table-responsive">

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



                        </tr>
                      </thead>
                      <tbody>
                      @foreach($fish as $fishes)
                        <tr class="">
                            <td>{{ $fishes->id}}</td>
                            <td>{{ $fishes->name}}</td>
                            <td>{{ $fishes->scientific_name}}</td>
                            <td>{{ $fishes-> category }}</td>
                            <td>{{ $fishes-> origin }}</td>
                            <td>{{ $fishes-> size }}</td>
                            <td>{{ $fishes-> characteristics }}</td>
                            <td>{{ $fishes-> aquarium_size }}</td>
                            <td>{{ $fishes-> temperature }}</td>
                            <td>{{ $fishes-> ph }}</td>
                            <td>{{ $fishes-> salinity }}</td>
                            <td>{{ $fishes-> lighting }}</td>


                          <div>
                            <td>
                              <a href="{{ route('manageikan', $fishes -> id) }}"  class="btn btn-primary btn-sm">Manage</a>
                            </td>
                            <td>

                              <form action="{{ route('deleteikan', $fishes -> id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" >
                                @csrf
                                @method('DELETE')

                                  <button  type="submit" class="btn btn-danger btn-sm">Remove</button>


                              </form>
                            </td>
                          </div>

                        </tr>


                      @endforeach


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pelatihan Table -->
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

          <!-- Fishmart Table -->
          <div class="row mb-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between m-2">
                            <h5 class="card-title mb-4">Tabel Produk</h5>
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
                                            <td>{{ $item->stok }}</td>
                                            <td>Rp {{ number_format($item->harga, 2) }}</td>
                                            <td>
                                                @if($item->gambar_produk)
                                                    <img src="{{ asset('storage/' . $item->gambar_produk) }}" alt="Gambar Produk" width="50">
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


</div>
@endsection

