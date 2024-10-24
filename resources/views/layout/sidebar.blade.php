

<nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
          <div class="user-info">
            <img src="images/bili.jpg" alt="">
            <p class="name">Selamat Datang, {{ Auth::user()->name}}!</p>
            <p class="designation">Project Manager</p>
            <span class="online"></span>
          </div>
          <ul class="nav">
            <li class="nav-item {{ Request::is('dashboard') ? 'active':'' }}">
              <a class="nav-link" href="/dashboard">
              <img src="images/logo_dashboard.png" alt="" >
                <span class="menu-title">Dashboard</span>
              </a>
            </li>


            <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" aria-expanded="false" aria-controls="User Data" href="#userdata">
              <img src="images/logo_user.png" alt="" >
                <span class="menu-title">User Data<i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="userdata">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item {{ Request::is('userpages') ? 'active':'' }}">
                    <a class="nav-link" href="/userpages">
                      <img src="images/icons/005-forms.png" alt="">
                      View Data
                    </a>
                  </li>

                  <li class="nav-item {{ Request::is('formuser') ? 'active':'' }}">
                    <a class="nav-link" href="/formuser">
                      <img src="images/icons/005-forms.png" alt="">
                      Add Data
                    </a>
                  </li>
                </ul>
              </div>
            </li>
           <li class="nav-item {{ Request::is('pelatihan') ? 'active':'' }}">
              <a class="nav-link" href="/pelatihan">
              <img src="images/pelatihan.png" alt="" >
                <span class="menu-title">Pelatihan</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('fishpedia') ? 'active':'' }}">
              <a class="nav-link" href="/fishpedia">
              <img src="images/lucide_fish.png" alt=""  >
                <span class="menu-title">Fishpedia</span>
              </a>
            </li>

            <li class="nav-item {{ Request::is('fishmart') ? 'active':'' }}">
              <a class="nav-link" href="/fishmart">
              <img src="images/logo_market.png" alt="">
                <span class="menu-title">FishMart</span>
              </a>
            </li>


            <li class="nav-item {{ Request::is('logout') ? 'active':'' }}">

              <form id="logout-form" action="/logout" method="POST" style="display: none;">
              @csrf
              </form>

              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

              <img src="images/logo_logout.png" alt="" >


                <span class="menu-title">Logout</span>

              </a>
            </li>

          </ul>
        </nav>
