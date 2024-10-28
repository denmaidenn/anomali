@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">History Transaction</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="card-title mb-4">Transaction Table</h5>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TRX-001</td>
                                    <td>PRD-001</td>
                                    <td>Ikan Cupang Blue Rim</td>
                                    <td>Ikan cupang dengan warna biru...</td>
                                    <td>
                                        <img src="path/to/image.jpg" alt="Ikan Cupang" style="width: 50px; height: 50px; object-fit: cover;">
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
                                        <img src="path/to/image.jpg" alt="Ikan Koi" style="width: 50px; height: 50px; object-fit: cover;">
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
                                        <img src="path/to/image.jpg" alt="Ikan Arwana" style="width: 50px; height: 50px; object-fit: cover;">
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

    <!-- Modal Detail -->
    <div class="modal fade" id="detail-1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi #TRX-001</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>ID Transaksi:</strong> TRX-001</p>
                            <p class="mb-2"><strong>ID Produk:</strong> PRD-001</p>
                            <p class="mb-2"><strong>Nama Produk:</strong> Ikan Cupang Blue Rim</p>
                            <p class="mb-2"><strong>Jumlah:</strong> 2</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Harga Satuan:</strong> Rp 75.000</p>
                            <p class="mb-2"><strong>Total Harga:</strong> Rp 150.000</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-2">Deskripsi Produk:</h6>
                        <p>Ikan cupang dengan warna biru...</p>
                    </div>
                    <div class="text-center">
                        <img src="path/to/image.jpg" alt="Ikan Cupang" style="max-width: 100%; height: auto; max-height: 300px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table.center-aligned-table thead tr th {
    white-space: nowrap;
    border-bottom: 1px;
}

.table.center-aligned-table tr {
    border-bottom: 1px solid #f3f1f1;
}

.table.center-aligned-table tr td {
    vertical-align: middle;
    border-top: none;
    padding: 0.75rem 0.75rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.card {
    margin-bottom: 1.5rem;
    box-shadow: 0 0 10px rgba(0,0,0,.03);
}

.page-heading {
    color: #1991EB;
    font-weight: 500;
}

.text-primary {
    color: #1991EB !important;
}

/* Tambahan style untuk gambar */
.table img {
    border-radius: 4px;
    border: 1px solid #dee2e6;
}
</style>
@endsection
