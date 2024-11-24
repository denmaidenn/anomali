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

                        <table id="feedbackTable" class="table center-aligned-table">
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
     @section('feedback_ajax')
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
                                        <td><a href="/feedback/${feedback.id}/show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                                        <td><a href="/feedback/${feedback.id}/edit" class="btn btn-primary btn-sm">Manage</a></td>
                                        <td>
                                            <form action="/feedback/${feedback.id}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                `);
                            });

                            // Inisialisasi DataTable
                            $('#feedbackTable').DataTable({
                                dom: 'Bfrtip',
                                buttons: [
                                    {
                                        extend: 'print',
                                        text: 'Print',
                                        title: 'Feedback Table',
                                        exportOptions: {
                                            columns: ':visible:not(:last-child):not(:nth-last-child(2)):not(:nth-last-child(3))' // Mengecualikan kolom "Details", "Manage", dan "Remove"
                                        }
                                    }
                                ]
                            });
                        } else {
                            $('#feedback-table-body').append('<tr><td colspan="6" class="text-center">Tidak ada data feedback.</td></tr>');
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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

