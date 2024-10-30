<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ $title }}</title>
  <link rel="icon" href="{{ asset('/images/iquarium.png') }}" type="image/png">
  <link rel="stylesheet" href="/node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="shortcut icon" href="/images/favicon.png" />
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div class=" container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layout.navbar')
        <!-- partial:partials/_sidebar.html -->
        @include('layout.sidebar')

    <!-- partial -->
    <div class="container-fluid">
      <div class="row row-offcanvas row-offcanvas-right">

        <!-- partial -->
        @yield('content')
        <!-- partial:partials/_footer.html -->
        @include('layout.footer')

        <!-- partial -->
      </div>
    </div>

  </div>

  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="/https://maps.googleapis.com/maps/api/js?key=AIzaSyB5NXz9eVnyJOA81wimI8WYE08kW_JMe8g&callback=initMap" async defer></script>
  <script src="/js/off-canvas.js"></script>
  <script src="/js/hoverable-collapse.js"></script>
  <script src="/js/misc.js"></script>
  <script src="/js/chart.js"></script>
  <script src="/js/maps.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#pelatihan-form').on('submit', function(e) {
              e.preventDefault(); // Prevent the default form submission

              $.ajax({
                  url: $(this).attr('action'),
                  method: 'POST',
                  data: $(this).serialize(),
                  success: function(response) {
                      // Clear the form
                      $('#pelatihan-form')[0].reset();

                      // Display success message
                      $('#ajax-notification').html('<div class="alert alert-success">' + response.message + '</div>');
                  },
                  error: function(xhr) {
                      // Display error messages
                      var errors = xhr.responseJSON.errors;
                      var errorHtml = '<div class="alert alert-danger"><ul>';
                      $.each(errors, function(key, value) {
                          errorHtml += '<li>' + value[0] + '</li>'; // Display the first error message for each field
                      });
                      errorHtml += '</ul></div>';
                      $('#ajax-notification').html(errorHtml);
                  }
              });
          });
      });
  </script>
  @yield('scripts')
</body>

</html>
