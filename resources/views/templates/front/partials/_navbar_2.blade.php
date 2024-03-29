<!-- NAVBAR
    ================================================= -->
    <nav class="navbar navbar-expand-lg navbar-dark trans-navigation fixed-top navbar-togglable">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h3>FOLANTAS</h3>
            </a>
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>

            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a href="{{ route('home') }}" class="nav-link js-scroll-trigger">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('themes.kecelakaan') }}" class="nav-link js-scroll-trigger">
                            Data Kecelakaan
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('themes.kemacetan') }}" class="nav-link js-scroll-trigger">
                            Data Kemacetan
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('themes.berita') }}" class="nav-link js-scroll-trigger">
                            Berita
                        </a>
                    </li>

                    @if(!Auth::user())
                        <li class="nav-item ">
                            <a href="{{ route('login') }}" class="nav-link">
                                Masuk
                            </a>
                        </li>
                    @else
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
                    @endif

                </ul>
            </div> <!-- / .navbar-collapse -->
        </div> <!-- / .container -->
    </nav>
