<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin - Register</title>
  <link rel="stylesheet" href="/node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="shortcut icon" href="/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Register</h3>
              <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <div class="form-group">
                  <input type="text" name="name" id="name" class="form-control p_input" placeholder="Name" value="{{ old('name') }}">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Email Field -->
                <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control p_input" placeholder="Email" value="{{ old('email') }}">
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control p_input" placeholder="Password">
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control p_input" placeholder="Confirm Password">
                </div>

                <!-- Terms and Conditions Checkbox -->
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label>
                      <input type="checkbox" class="form-check-input"> I Agree to the Terms & Conditions
                    </label>
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">Register</button>
                </div>

                <!-- Existing User Link -->
                <p class="existing-user text-center pt-4 mb-0">Already have an account?&nbsp;<a href="/signin">Sign In</a></p>
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
</body>

</html>
