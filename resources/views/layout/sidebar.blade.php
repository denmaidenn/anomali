

<nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
          <div class="bg-white text-center">
            <a class="navbar-brand brand-logo text-center w-100" href="index.html"><img src="{{ asset('images/iquarium.png') }}" style="max-width: 160px; display: inline-block;"  alt="iQuarium Logo" /></a>

          </div>
          <div class="user-info">
              <img id="user-photo" src="{{ asset('images/user.png') }}" alt="User Photo" class="rounded-circle" style="width: 80px; height: 80px;">
              <p id="user-name" class="name">Loading...</p>
              <p id="user-email" class="designation">Loading...</p>
              <p class="designation">Admin</p>
              <span class="online"></span>
          </div>

          <ul class="nav">
            <li class="nav-item {{ Request::is('dashboard') ? 'active':'' }}">
              <a class="nav-link" href="/dashboard">
              <img src="{{ asset('images/logo_dashboard.png') }}" alt="" >
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('user') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
              <img src="{{ asset('images/logo_user.png') }}" alt="" >
                <span class="menu-title">Mobile User</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('fishpedia') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('fishpedia.index') }}">
              <img src="{{ asset('images/lucide_fish.png') }}" alt=""  >
                <span class="menu-title">Fishpedia</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#pelatihan-menu" aria-expanded="false" aria-controls="pelatihan-menu">
                <img src="{{ asset('images/pelatihan.png') }}" alt="">
                <span class="menu-title">Pelatihan <i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="pelatihan-menu">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item {{ Request::is('pelatih') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('pelatih.index') }}">
                      <img src="{{ asset('images/pelatih.png') }}" alt="Market Icon">
                      Pelatih 
                    </a>
                  </li>
                  <li class="nav-item {{ Request::is('pelatihan') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('pelatihan.index') }}">
                      <img src="{{ asset('images/pelatihan.png') }}" alt="Market Icon">
                      Pelatihan 
                    </a>
                  </li>
                  <li class="nav-item {{ Request::is('pelatihanfree') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('pelatihanfree.index') }}">
                      <img src="{{ asset('images/pelatihan.png') }}" alt="Cart Icon">
                      Pelatihan (Free)
                    </a>
                  </li>
                  <li class="nav-item {{ Request::is('checkout') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('checkout.index') }}">
                      <img src="{{ asset('images/checkout.png') }}" alt="Checkout Icon">
                      Checkout
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#fishmart-menu" aria-expanded="false" aria-controls="fishmart-menu">
                <img src="{{ asset('images/logo_market.png') }}" alt="">
                <span class="menu-title">Fishmart <i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="fishmart-menu">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item {{ Request::is('fishmart') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('fishmart.index') }}">
                      <img src="{{ asset('images/logo_market.png') }}" alt="Market Icon">
                      Produk
                    </a>
                  </li>
                  <li class="nav-item {{ Request::is('cart') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                      <img src="{{ asset('images/cart.png') }}" alt="Cart Icon">
                      Cart
                    </a>
                  </li>
                  <li class="nav-item {{ Request::is('checkout') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('checkout.index') }}">
                      <img src="{{ asset('images/checkout.png') }}" alt="Checkout Icon">
                      Checkout
                    </a>
                  </li>
                </ul>
              </div>
            </li>



            <li class="nav-item {{ Request::is('feedback') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('feedback.index') }}">
              <img src="{{ asset('images/logo_feedback.png') }}" alt="">
                <span class="menu-title">Feedback</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('admin/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('sign.show', ['id' => Auth::user()->id]) }}">
                    <img src="{{ asset('images/settings.png') }}" alt="Settings Icon">
                    <span class="menu-title">Settings</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('logout') ? 'active':'' }}">
              <form id="logout-form" action="/logout" method="POST" style="display: none;">
              @csrf
              </form>
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <img src="{{ asset('images/logo_logout.png') }}" alt="" >
                <span class="menu-title">Logout</span>
              </a>
            </li>
          </ul>
        </nav>

  <script>
      // Fetch user data from the API
      const userId = {{ Auth::user()->id }};
      console.log("Fetching data for userId:", userId);

      fetch(`/api/admin/${userId}`)
          .then(response => {
              console.log("API response status:", response.status);
              return response.json();
          })
          .then(data => {
              console.log("API response data:", data);
              if (data.success) {
                  const user = data.data;

                  // Update user photo
                  const userPhoto = user.gambar_profile ? `/storage/${user.gambar_profile}` : '/images/user.png';
                  document.getElementById('user-photo').src = userPhoto;

                  // Update user name and email
                  document.getElementById('user-name').textContent = user.name;
                  document.getElementById('user-email').textContent = user.email;

                  console.log("User data successfully updated in the UI.");
              } else {
                  console.error("User not found:", data.message);
              }
          })
          .catch(error => {
              console.error("Error fetching user data:", error);
          });
  </script>
