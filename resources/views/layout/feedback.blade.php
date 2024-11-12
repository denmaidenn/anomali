    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="card-title mb-4">Feedback Table</h5>
                        <a href="{{ route('feedback.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <!-- Success or error message -->
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
                                    <th>User</th>
                                    <th>Komentar</th>
                                    <th>Details</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="feedback-table-body">
                                <!-- Feedback data will be loaded here with AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for AJAX to fetch feedback data -->
     @section('ajax')
        <script>
            loadFeedbackData();

            function loadFeedbackData() {
                $.ajax({
                    url: '/api/feedback',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#feedback-table-body').empty();
                        if (response.data.length > 0) {
                            response.data.forEach(function(feedback, index) {
                                $('#feedback-table-body').append(`
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${feedback.user ? feedback.user.name : 'Unknown User'}</td>
                                        <td>${feedback.komentar}</td>
                                        <td><a href="/feedback/show/${feedback.id}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                        <td><a href="/feedback/edit/${feedback.id}" class="btn btn-primary btn-sm">Manage</a></td>
                                        <td>
                                            <form action="/feedback/${feedback.id}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('#feedback-table-body').append('<tr><td colspan="4" class="text-center">Tidak ada data feedback.</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Terjadi kesalahan saat memuat data feedback.');
                    }
                });
            }
        </script>
     @endsection

