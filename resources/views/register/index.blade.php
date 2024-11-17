<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>iQuarium Register</title>
  <link rel="stylesheet" href="/node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="shortcut icon" href="/images/favicon.png" />
  <style>
    .logo {
      display: block;
      margin: 0 auto; /* Center the logo horizontally */
      width: min-content; /* Adjust logo size if needed */
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <!-- Logo -->
              <img src="/images/iquarium.png" alt="iQuarium Logo" class="logo">

              <h3 class="card-title text-left mb-3">Register</h3>
              <form id="createUserForm">
                  <div class="form-group">
                      <input type="text" class="form-control p_input" placeholder="Name" name="name" required>
                  </div>
                  <div class="form-group">
                      <input type="email" class="form-control p_input" placeholder="Email" name="email" required>
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control p_input" placeholder="Password" name="password" required>
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control p_input" placeholder="Confirm Password" name="password_confirmation" required>
                  </div>
                  <div class="text-center">
                      <button type="button" class="btn btn-primary btn-block" onclick="createUser()">Create Admin</button>
                  </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="/js/misc.js"></script>
  <script>
function createUser() {
    const form = document.getElementById('createUserForm');
    const formData = new FormData(form);

    // Client-side password confirmation validation
    const password = formData.get('password');
    const passwordConfirmation = formData.get('password_confirmation');

    if (password !== passwordConfirmation) {
        alert('Passwords do not match');
        return;
    }

    fetch('/api/admin/create', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw err;
            });
        }
        return response.json();
    })
    .then(data => {
        alert(data.message); // Display success message
        console.log(data.data); // New user data

        // Redirect to the home page after successful account creation
        window.location.href = '/'; // Redirect to the home page
    })
    .catch(error => {
        if (error.errors) {
            for (const key in error.errors) {
                alert(error.errors[key]); // Show validation errors
            }
        } else {
            console.error('Error:', error);
        }
    });
}
  </script>
</body>

</html>
