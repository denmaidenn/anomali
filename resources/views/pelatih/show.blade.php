@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Detail Pelatih</h3>
    <div id="pelatihDetail">
        <div>Loading...</div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('pelatih.index') }}" class="btn btn-secondary me-2">Kembali</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Ambil ID pelatih dari URL atau variabel server-side
    const pelatihId = "{{ $pelatih->id ?? '' }}";

    // Fetch data dari API
    fetch(`/api/pelatih/${pelatihId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data);
                const pelatih = data.data;

                // Tampilkan data di dalam HTML
                const detailHtml = `
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">${pelatih.nama}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Nama:</strong></div>
                                <div class="col-md-8">${pelatih.nama || 'Tidak Ditemukan'}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Email:</strong></div>
                                <div class="col-md-8">${pelatih.email || 'Tidak Ada Email'}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>No. Telepon:</strong></div>
                                <div class="col-md-8">${pelatih.no_telp || 'Tidak Ada Nomor Telepon'}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Alamat:</strong></div>
                                <div class="col-md-8">${pelatih.alamat || 'Tidak Ada Alamat'}</div>
                            </div>
                        </div>
                    </div>
                `;

                document.getElementById('pelatihDetail').innerHTML = detailHtml;
            } else {
                document.getElementById('pelatihDetail').innerHTML = `<div>Data pelatih tidak ditemukan</div>`;
            }
        })
        .catch(error => {
            console.error('Error fetching pelatih:', error);
            document.getElementById('pelatihDetail').innerHTML = `<div>Error loading data</div>`;
        });
</script>
@endsection
