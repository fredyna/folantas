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
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="icon-rocket menu-icon"></i>
          <span class="menu-title">Dashboard</span>
          <span class="badge badge-success"></span>
        </a>
      </li>

      @if (Auth()->user()->role_id == 1)
      <li id="notifikasi" class="nav-item">
        <a class="nav-link" href="{{ route('notifikasi.index') }}">
          <i class="icon-bell menu-icon"></i>
          <span class="menu-title">Notifikasi</span>
          <span class="badge badge-success">{{ Auth::user()->unreadNotifications()->count() }}</span>
        </a>
      </li>

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

        <li id="data-kemacetan" class="nav-item">
            <a class="nav-link" href="{{ route('data-kemacetan.index') }}">
            <i class="icon-chart menu-icon"></i>
            <span class="menu-title">Data Kemacetan</span>
            <span class="badge badge-success"></span>
            </a>
        </li>

        @if (Auth()->user()->role_id == 1)
        <li id="berita" class="nav-item">
            <a class="nav-link" href="{{ route('berita.index') }}">
            <i class="icon-list menu-icon"></i>
            <span class="menu-title">Manajemen Berita</span>
            <span class="badge badge-success"></span>
            </a>
        </li>
        @endif

        <li id="data-laporan" class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
                <i class="icon-docs menu-icon"></i>
                <span class="menu-title">Data Laporan</span>
                <span class="badge badge-info"></span>
            </a>
            <div class="collapse" id="laporan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a id="lapor-kecelakaan" class="nav-link" href="{{ route('lapor-kecelakaan.index') }}">Lapor Kecelakaan</a></li>
                    <li class="nav-item"> <a id="lapor-kemacetan" class="nav-link" href="{{ route('lapor-kemacetan.index') }}">Lapor Kemacetan</a></li>
                </ul>
            </div>
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

        <li id="berita" class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="icon-logout menu-icon"></i>
                <span class="menu-title">Keluar</span>
                <span class="badge badge-success"></span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

      {{-- @if (Auth()->user()->role_id == 1)
        <li id="log" class="nav-item">
            <a class="nav-link" href="{{ route('log.index') }}">
            <i class="icon-book-open menu-icon"></i>
            <span class="menu-title">Data Log</span>
            <span class="badge badge-success"></span>
            </a>
        </li>
      @endif --}}

    </ul>
  </nav>
  <!-- partial -->
