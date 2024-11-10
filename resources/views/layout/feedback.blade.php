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
    @section('scripts')
        <script>
            $(document).ready(function() {
                function loadUserData() {
                    $.ajax({
                        url: '/api/feedback', // API endpoint for feedback data
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            // Clear the table before loading new data
                            $('#feedback-table-body').empty();
                        
                            // Check if data is correctly received and append to the table
                            if (response.length > 0) {
                                response.forEach(function(feedback, index) {
                                    $('#feedback-table-body').append(`
                                        <tr>
                                            <td>${index + 1}</td>
                                            <td>${feedback.user ? feedback.user.name : 'Anonymous'}</td>
                                            <td>${feedback.komentar}</td>
                                            <td>
                                                <a href="/feedback/${feedback.id}/edit" class="btn btn-primary btn-sm">Manage</a>
                                            </td>
                                            <td>
                                                <form action="/feedback/${feedback.id}/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    `);
                                });
                            } else {
                                $('#feedback-table-body').append('<tr><td colspan="5" class="text-center">No feedback available.</td></tr>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            alert('An error occurred while loading feedback data.');
                        }
                    });
                }

                loadUserData();
            });
        </script>    

    @endsection
