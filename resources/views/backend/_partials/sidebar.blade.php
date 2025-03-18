<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="{{ url('/') }}" class="logo">
        <img src="{{ url('backend/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
          <a href="{{ route('user') }}">
            <i class="fas fa-users"></i>
            <p>Data Users</p>
          </a>
        </li>
        
          <li class="nav-item {{ Request::is('students*') ? 'active' : '' }}">
          <a href="{{ route('students') }}">
              <i class="fas fa-user-graduate"></i>
              <p>Data Students</p>
          </a>
        </li>

        <li class="nav-item {{ Request::is('teacher*') ? 'active' : '' }}">
            <a href="{{ route('teacher') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <p>Data Teachers</p>
            </a>
        </li>

        <li class="nav-item {{ request()->is('mapel*') ? 'active' : '' }}">
            <a href="{{ route('mapel') }}" class="{{ request()->is('mapel*') ? 'active-link' : '' }}">
                <i class="fas fa-book"></i>
                <p>Mata Pelajaran</p>
            </a>
        </li>

        <li class="nav-item {{ request()->is('nilai*') ? 'active' : '' }}">
            <a href="{{ route('nilai') }}" class="{{ request()->is('nilai*') ? 'active-link' : '' }}">
                <i class="fas fa-star"></i>
                <p>Nilai</p>
            </a>
        </li>

        <li class="nav-item">
          <!-- Authentication -->
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>

      <style>
        .sidebar-wrapper {
            background: #222;
            color: white;
            min-height: 100vh;
            padding-top: 10px;
        }

        .sidebar-content .nav-secondary {
            list-style: none;
            padding-left: 0;
        }

        .sidebar-content .nav-item {
            position: relative;
            margin-bottom: 5px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar-content .nav-item a {
            display: flex;
            align-items: center;
            padding: 12px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar-content .nav-item a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar-content .nav-item a:hover {
            background: #444;
            transform: scale(1.05);
        }

        .sidebar-content .nav-item.active a i {
            animation: bounce 0.6s infinite alternate;
        }

        /* Animasi Ikon */
        @keyframes bounce {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-3px); }
        }

    </style>
        </li>
      </ul>
    </div>
  </div>
</div>

