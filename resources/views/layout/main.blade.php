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
<div class="loader-wrapper">
        <div class="loader"></div>
    </div>
  <div class=" container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layout.navbar')
        <!-- partial:partials/_sidebar.html -->


    <!-- partial -->
    <div class="container-fluid">
      <div class="row row-offcanvas row-offcanvas-right">

        @include('layout.sidebar')
        <!-- partial -->
        @yield('content')
        <!-- partial:partials/_footer.html -->
        @include('layout.footer')

        <!-- partial -->
      </div>
    </div>

  </div>
  <script src="{{ asset('js/custom.js') }}"></script>
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
  @yield('scripts')
  @yield('user_ajax')
  @yield('fishpedia_ajax')
  @yield('pelatihan_ajax')
  @yield('pelatih_ajax')
  @yield('fishmart_ajax')
  @yield('feedback_ajax')

</body>

</html>
