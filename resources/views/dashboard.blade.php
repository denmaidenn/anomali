@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Widgets</h3>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User Data Table</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between mb-4">
                            </div>
                            <!-- Tambahkan class table-responsive untuk membuat tabel lebih fleksibel -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Prodi</th>
                                            <th>Kelas</th>
                                            <th>Jenis Kelamin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->prodi }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>{{ $item->jenis_kelamin }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- End table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
