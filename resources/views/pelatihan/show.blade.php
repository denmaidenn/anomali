@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Detail Pelatihan</h3>
    <div id="pelatihanDetail">
        <div>Loading...</div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary me-2">Kembali</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Ambil ID pelatihan dari URL
    const pelatihanId = "{{ $pelatihan->id ?? '' }}";

    // Fetch data dari API
    fetch(`/api/pelatihan/${pelatihanId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const pelatihan = data.data;

                // Tampilkan data di dalam HTML
                const detailHtml = `
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">${pelatihan.judul}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Pelatih:</strong></div>
                                <div class="col-md-8">${pelatihan.user?.nama || 'Pelatih Tidak Ditemukan'}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Deskripsi Pelatihan:</strong></div>
                                <div class="col-md-8">${pelatihan.deskripsi_pelatihan || 'Tidak ada deskripsi.'}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Video Pelatihan:</strong></div>
                                <div class="col-md-8">
                                    ${pelatihan.video_pelatihan 
                                        ? `<video width="320" height="240" controls>
                                            <source src="/storage/${pelatihan.video_pelatihan}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>` 
                                        : '<span>No Video Available</span>'}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Gambar Pelatihan:</strong></div>
                                <div class="col-md-8">
                                    ${pelatihan.gambar_pelatihan 
                                        ? `<img src="/storage/${pelatihan.gambar_pelatihan}" alt="Gambar Pelatihan" style="width: 100px; height: auto;">`
                                        : '<span>No Image Available</span>'}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Harga:</strong></div>
                                <div class="col-md-8">Rp ${new Intl.NumberFormat().format(pelatihan.harga)}</div>
                            </div>
                        </div>
                    </div>
                `;

                document.getElementById('pelatihanDetail').innerHTML = detailHtml;
            } else {
                document.getElementById('pelatihanDetail').innerHTML = `<div>Data tidak ditemukan</div>`;
            }
        })
        .catch(error => {
            console.error('Error fetching pelatihan:', error);
            document.getElementById('pelatihanDetail').innerHTML = `<div>Error loading data</div>`;
        });
</script>
@endsection
