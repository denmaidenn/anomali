

<nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
          <div class="bg-white text-center">
            <a class="navbar-brand brand-logo text-center w-100" href="index.html"><img src="{{ asset('images/iquarium.png') }}" style="max-width: 160px; display: inline-block;"  alt="iQuarium Logo" /></a>

          </div>
          <div class="user-info">
              <img src="{{ Auth::user()->gambar_profile ? asset('storage/' . Auth::user()->gambar_profile) : asset('images/user.png') }}" alt="User Photo" class="rounded-circle" style="width: 80px; height: 80px;">
              <p class="name">{{ Auth::user()->name }}</p>
              <p class="designation">{{ Auth::user()->email }}</p>
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

           <li class="nav-item {{ Request::is('pelatihan') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('pelatihan.index') }}">
              <img src="{{ asset('images/pelatihan.png') }}" alt="" >
                <span class="menu-title">Pelatihan</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('pelatihanfree') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('pelatihanfree.index') }}">
              <img src="{{ asset('images/pelatihan.png') }}" alt="" >
                <span class="menu-title">Pelatihan (Free)</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('pelatih') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('pelatih.index') }}">
              <img src="{{ asset('images/pelatih.png') }}" alt="">
                <span class="menu-title">Pelatih</span>
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
                <span class="menu-title">Fishmart</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('feedback') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('feedback.index') }}">
              <img src="{{ asset('images/logo_feedback.png') }}" alt="">
                <span class="menu-title">Feedback</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('admin') ? 'active':'' }}">
              <a class="nav-link" href="{{ route('sign.edit', ['id' => Auth::user()->id] ) }}">
              <img src="{{ asset('images/settings.png') }}" alt="" >
                <span class="menu-title">Setting</span>
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
