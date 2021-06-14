<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <div class="nav-link">
          <div class="profile-image">
            <img src="{{ asset('assets/images/user.png') }}" alt="image"/>
            <span class="online-status online"></span> <!--change class online to offline or busy as needed-->
          </div>
          <div class="profile-name">
            <p class="name">
                {{ Str::limit(Auth()->user()->name, 20) }}
            </p>
            <p class="designation">
              {{ Str::limit(Auth()->user()->role->description, 30) }}
            </p>
          </div>
        </div>
      </li>
      <li id="dashboard" class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="icon-rocket menu-icon"></i>
          <span class="menu-title">Dashboard</span>
          <span class="badge badge-success"></span>
        </a>
      </li>

      <li id="notifikasi" class="nav-item">
        <a class="nav-link" href="{{ route('notifikasi.index') }}">
          <i class="icon-bell menu-icon"></i>
          <span class="menu-title">Notifikasi</span>
          <span class="badge badge-success"></span>
        </a>
      </li>

        @if (Auth()->user()->role_id == 1)
        <li id="user" class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">Data User</span>
            </a>
        </li>
        @endif

        <li id="data-kecelakaan" class="nav-item">
            <a class="nav-link" href="{{ route('data-kecelakaan.index') }}">
            <i class="icon-chart menu-icon"></i>
            <span class="menu-title">Data Kecelakaan</span>
            <span class="badge badge-success"></span>
            </a>
        </li>

        <li id="berita" class="nav-item">
            <a class="nav-link" href="{{ route('berita.index') }}">
            <i class="icon-list menu-icon"></i>
            <span class="menu-title">Manajemen Berita</span>
            <span class="badge badge-success"></span>
            </a>
        </li>

        @if (Auth()->user()->role_id == 1)
        <li id="master" class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">Data Master</span>
                <span class="badge badge-info"></span>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a id="master-role" class="nav-link" href="{{ route('role.index') }}">Role User</a></li>
                </ul>
            </div>
        </li>
        @endif

      @if (Auth()->user()->role_id == 1)
        <li id="log" class="nav-item">
            <a class="nav-link" href="{{ route('log.index') }}">
            <i class="icon-book-open menu-icon"></i>
            <span class="menu-title">Data Log</span>
            <span class="badge badge-success"></span>
            </a>
        </li>
      @endif

    </ul>
  </nav>
  <!-- partial -->
