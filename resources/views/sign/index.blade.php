<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>iQuarium Admin</title>
  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="shortcut icon" href="images/favicon.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">

              @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: '{{ session('success') }}',
                    }).then(() => {
                        // Redirect to the intended page after alert is closed
                        window.location.href = '{{ url()->previous() }}'; // Ganti dengan URL yang sesuai
                    });
                </script>
              @endif
              @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ session('error') }}',
                    });
                </script>
              @endif
              <h3 class="card-title text-left mb-3">Login</h3>


              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control p_input" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control p_input" placeholder="Password" name="password" required>
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check"><label><input type="checkbox" class="form-check-input">Remember me</label></div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn" value="SIGN IN ">LOG IN</button>
                </div>
                <a href="/register" class="google-login btn btn-create-account btn-block">Create An Account</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="js/misc.js"></script>
</body>

</html>
