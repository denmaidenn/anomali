@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Fish Mart</h3>

    <!-- Sales Chart Card -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="card-title">Grafik Penjualan</h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Mingguan</button>
                            <button type="button" class="btn btn-secondary">Bulanan</button>
                        </div>
                    </div>

                    <!-- Chart Container -->
                    <div class="product-chart-wrapper" style="height: 200px;">
                        <canvas id="salesChart"></canvas>
                    </div>

                    <!-- Chart Legend -->
                    <div id="sales-chart-legend" class="mt-2">
                        <ul>
                            <li>
                                <span style="background-color: #1991EB"></span>
                                Total Penjualan
                            </li>
                            <li>
                                <span style="background-color: #58d8a3"></span>
                                Target Penjualan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Table -->
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="card-title mb-4">Transaction Table</h5>
                        <div class="search-container">
                            <form class="form-inline" action="{{ route('search') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control search" name="query"
                                           placeholder="Search transactions..." data-page="fishmart.index">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <a href="{{ route('fishmart.create') }}" class="btn btn-primary">Tambah</a>

                    </div>

                    <div class="table-responsive">
                        <table class="table center-aligned-table">
                            <thead>
                                <tr class="text-primary">
                                    <th>ID Transaksi</th>
                                    <th>ID Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi Produk</th>
                                    <th>Gambar Produk</th>
                                    <th>Jumlah Produk</th>
                                    <th>Harga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TRX-001</td>
                                    <td>PRD-001</td>
                                    <td>Ikan Cupang Blue Rim</td>
                                    <td>Ikan cupang dengan warna biru...</td>
                                    <td>
                                        <img src="path/to/image.jpg" alt="Ikan Cupang" class="table-image">
                                    </td>
                                    <td>2</td>
                                    <td>Rp 150.000</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail-1">
                                            <i class="fa fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TRX-002</td>
                                    <td>PRD-002</td>
                                    <td>Ikan Koi Butterfly</td>
                                    <td>Ikan koi dengan corak butterfly...</td>
                                    <td>
                                        <img src="path/to/image.jpg" alt="Ikan Koi" class="table-image">
                                    </td>
                                    <td>1</td>
                                    <td>Rp 500.000</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail-2">
                                            <i class="fa fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TRX-003</td>
                                    <td>PRD-003</td>
                                    <td>Ikan Arwana Super Red</td>
                                    <td>Ikan arwana dengan warna merah...</td>
                                    <td>
                                        <img src="path/to/image.jpg" alt="Ikan Arwana" class="table-image">
                                    </td>
                                    <td>1</td>
                                    <td>Rp 2.500.000</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail-3">
                                            <i class="fa fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Daftar Produk</h3>
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




