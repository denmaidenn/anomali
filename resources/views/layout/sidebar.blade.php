

<nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
          <div class="bg-white text-center">
            <a class="navbar-brand brand-logo text-center w-100" href="index.html"><img src="{{ asset('images/iquarium.png') }}" style="max-width: 160px; display: inline-block;"  alt="iQuarium Logo" /></a>

          </div>
          <div class="user-info">
            <img src="{{ asset('images/bili.jpg') }}" alt="">
            <p class="name">Selamat Datang, {{ Auth::user()->name}}!</p>
            <p class="designation">Project Manager</p>
            <span class="online"></span>
          </div>
          <ul class="nav">
            <li class="nav-item {{ Request::is('dashboard') ? 'active':'' }}">
              <a class="nav-link" href="/dashboard">
              <img src="{{ asset('images/logo_dashboard.png') }}" alt="" >
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" aria-expanded="false" aria-controls="User Data" href="#userdata">
              <img src="{{ asset('images/logo_user.png') }}" alt="" >
                <span class="menu-title">User Data<i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="userdata">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item {{ Request::is('userpages') ? 'active':'' }}">
                    <a class="nav-link" href=" {{ route('user.index') }}">
                      <img src="{{ asset('images/icons/005-forms.png') }}" alt="">
                      View Data
                    </a>
                  </li>

                  <li class="nav-item {{ Request::is('formuser') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('user.create') }}">
                      <img src="{{ asset('images/icons/005-forms.png') }}" alt="">
                      Add Data
                    </a>
                  </li>
                </ul>
              </div>
            </li>
           <li class="nav-item {{ Request::is('pelatihan') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('pelatihan.index') }}">
              <img src="{{ asset('images/pelatihan.png') }}" alt="" >
                <span class="menu-title">Pelatihan</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('fishpedia') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('fishpedia.index') }}">
              <img src="{{ asset('images/lucide_fish.png') }}" alt=""  >
                <span class="menu-title">Fishpedia</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('fishmart') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('fishmart.index') }}">
              <img src="{{ asset('images/logo_market.png') }}" alt="">
                <span class="menu-title">FishMart</span>
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
