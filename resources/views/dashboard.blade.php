@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Dashboard</h3>

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
</div>
@endsection
