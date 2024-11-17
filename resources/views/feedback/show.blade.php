@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: bold">Detail Feedback</h3>
    <div id="feedbackDetail">
        <div>Loading...</div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('feedback.index') }}" class="btn btn-secondary me-2">Kembali</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Ambil ID feedback dari URL
    const feedbackId = "{{ $feedback->id ?? '' }}";

    // Fetch data dari API
    fetch(`/api/feedback/${feedbackId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data);
                const feedback = data.data;

                // Tampilkan data di dalam HTML
                const detailHtml = `
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Feedback oleh: ${feedback.user?.name || 'Pelatih Tidak Ditemukan'}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>User:</strong></div>
                                <div class="col-md-8">${feedback.user?.name || 'Tidak ada user'}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Komentar:</strong></div>
                                <div class="col-md-8">${feedback.komentar || 'Tidak ada komentar'}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Tanggal Dibuat:</strong></div>
                                <div class="col-md-8">${new Date(feedback.created_at).toLocaleString()}</div>
                            </div>
                        </div>
                    </div>
                `;

                document.getElementById('feedbackDetail').innerHTML = detailHtml;
            } else {
                document.getElementById('feedbackDetail').innerHTML = `<div>Data tidak ditemukan</div>`;
            }
        })
        .catch(error => {
            console.error('Error fetching feedback:', error);
            document.getElementById('feedbackDetail').innerHTML = `<div>Error loading data</div>`;
        });
</script>
@endsection
