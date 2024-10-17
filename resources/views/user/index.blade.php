@extends('layout.main')

@section('content')
<div class="content-wrapper">
          <h3 class="page-heading mb-4">Bootstrap Tables</h3>
          <div class="row mb-2">
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
                      @foreach($data as $item)
                        <tr class="">
                          <td>{{ $item->id}}</td>
                          <td>{{ $item-> name }}</td>
                          <td>{{ $item-> email }}</td>
                          <td>{{ $item-> prodi }}</td>
                          <td>{{ $item-> kelas }}</td>
                          <td>{{ $item-> jenis_kelamin }}</td>
                          <div>
                            <td>
                              <a href="/edituser" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                            <td>
                              <a href="/removeuser" class="btn btn-danger btn-sm">Remove</a>
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