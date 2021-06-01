<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-red">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      <a class="navbar-brand brand-logo" href="#">FOLANTAS</a>
      <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('assets/images/logo/logo.svg')}}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>

      <ul class="navbar-nav navbar-nav-right">

        {{-- menu account  --}}
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <i class="icon-user mx-0"></i>
            <span class=""></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
            {{-- <a href="#" style="text-decoration: none;">
                <div class="dropdown-item">
                    <p class="mb-0 font-weight-normal float-left">
                        <i class="icon-settings"></i>
                        Pengaturan
                    </p>
                </div>
            </a>
            <div class="dropdown-divider"></div> --}}
            <a href="{{ route('logout') }}" style="text-decoration: none;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <div class="dropdown-item">
                    <p class="mb-0 font-weight-normal float-left">
                        <i class="icon-logout"></i>
                        {{ __('Keluar') }}
                    </p>
                </div>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </li>
        {{-- end menu account  --}}

      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
