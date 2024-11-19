@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Form</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Feedback Form</h5>

                    <!-- Notifications for success and error -->
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

                    <form class="forms-sample" method="POST" action="{{ route('feedback.store') }}">                        @csrf

                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="" disabled selected>Pilih User</option>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="komentar">Komentar</label>
                            <textarea name="komentar" class="form-control p-input" id="komentar" placeholder="Masukkan komentar Anda" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to fetch and populate the user data -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fetch user data from the API and populate the dropdown
    fetch('/api/formuser')
        .then(response => response.json())
        .then(users => {
            const userSelect = document.getElementById('user_id');
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = user.name;
                userSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching users:', error));
});

// function submitFeedback() {
//     const form = document.querySelector('.forms-sample');
//     const formData = new FormData(form);

//     fetch('/api/feedback/create', {
//         method: 'POST',
//         headers: {
//             'Accept': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//         },
//         body: formData,
//     })
//     .then(response => {
//         if (!response.ok) {
//             return response.json().then(err => {
//                 throw err;
//             });
//         }
//         return response.json();
//     })
//     .then(data => {
//         alert('Feedback submitted successfully!');
//         console.log(data.feedback); // Log the feedback data

//         // Redirect or clear form fields after successful submission
//         form.reset();
//     })
//     .catch(error => {
//         if (error.errors) {
//             for (const key in error.errors) {
//                 alert(error.errors[key]); // Show validation errors
//             }
//         } else {
//             console.error('Error:', error);
//         }
//     });
// }
</script>
@endsection
