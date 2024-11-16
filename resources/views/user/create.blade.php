@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Form</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form User Data</h5>
                    <form id="userForm">
                        <div class="form-group">
                            <label for="exampleInputName1">Nama</label>
                            <input name="name" type="text" class="form-control p-input" id="name" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control p-input" id="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername">Username</label>
                            <input name="username" type="text" class="form-control p-input" id="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input name="password" type="password" class="form-control p-input" id="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="button" id="submitForm" class="btn btn-primary">Submit</button>
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
        document.getElementById('submitForm').addEventListener('click', function () {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            fetch('/api/formuser/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    username: username,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User created successfully!');
                    console.log(data.data); // New user data

                    // Redirect to the home page after successful account creation
                    window.location.href = '{{ route("user.index") }}'; // Redirect to the home page
                } else {
                    alert('Failed to create user: ' + JSON.stringify(data));
                }
            })
            .catch(error => console.error('Error:', error));
        });

    </script>
@endsection
