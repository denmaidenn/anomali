@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Forms</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Edit Feedback</h5>
                    <form class="forms-sample" id="editFeedbackForm">                       
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="" disabled>Pilih User</option>
                                <!-- User options will be populated dynamically -->
                            </select>
                            <div id="error_user_id" class="text-danger"></div> <!-- Error message for user_id -->
                        </div>
                        <div class="form-group">
                            <label for="komentar">Komentar</label>
                            <textarea name="komentar" class="form-control p-input" id="komentar" placeholder="Masukkan komentar Anda" required></textarea>
                            <div id="error_komentar" class="text-danger"></div> <!-- Error message for komentar -->
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="submitButton">Update</button>
                            <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        // Ensure that feedbackId is passed correctly
        const feedbackId = {{ $feedback->id }};  // Get feedback ID from the blade template

        // Fetch feedback data and populate the form fields
        window.onload = function() {
            fetch(`/api/feedback/${feedbackId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const feedback = data.data;
                        document.getElementById('komentar').value = feedback.komentar;

                        // Populate the user dropdown
                        const userSelect = document.getElementById('user_id');
                        if (Array.isArray(data.users) && data.users.length > 0) {
                            data.users.forEach(user => {
                                let option = document.createElement('option');
                                option.value = user.id;
                                option.text = user.name;
                                option.selected = user.id === feedback.user_id; // Select the current user
                                userSelect.appendChild(option);
                            });
                            console.log("Selected user_id:", formData.get('user_id'));
                        }
                    } else {
                        console.error('Feedback not found');
                    }
                })
                .catch(error => {
                    console.error('Error fetching feedback data:', error);
                });
        };

        // Handle form submission
        document.getElementById('submitButton').addEventListener('click', function(e) {
    e.preventDefault();

    const formData = new FormData(document.getElementById('editFeedbackForm'));
    formData.append('_method', 'PUT'); // Simulating PUT request
    const token = 'yourActualTokenHere'; // Masukkan token autentikasi yang benar

    fetch(`/api/feedback/${feedbackId}`, {
        method: 'POST', // Use POST but simulate PUT with _method field
        headers: {
            'Authorization': `Bearer ${token}`, // If your app uses bearer token authentication
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData // Send the form data as the request body
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(errorData => Promise.reject(errorData));
        }
        return response.json();
    })
    .then(data => {
        console.log("API response data:", data);

        if (data.success) {
            console.log(data);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.message, // Menampilkan pesan sukses
            }).then(() => {
                window.location.href = "{{ route('feedback.index') }}"; // Redirect ke halaman index feedback setelah berhasil
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Gagal memperbarui feedback', // Menampilkan pesan gagal
            });
        }
    })
    .catch(error => {
        console.error('Error updating feedback data:', error);
        if (error && error.errors) {
            // Handle validation errors and display them in the UI if needed
            Object.keys(error.errors).forEach(key => {
                const errorElement = document.getElementById('error_' + key);
                if (errorElement) {
                    errorElement.innerText = error.errors[key].join(', ');
                }
            });
        }
    });

});

    </script>
@endsection
