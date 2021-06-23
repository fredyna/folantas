<!-- NAVBAR
    ================================================= -->
    <nav class="navbar navbar-expand-lg navbar-dark trans-navigation fixed-top navbar-togglable">
        <div class="container">
            <a class="navbar-brand" href="index-3.html">
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
                        <a href="#" class="nav-link js-scroll-trigger">
                            Data Kemacetan
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('themes.berita') }}" class="nav-link js-scroll-trigger">
                            Berita
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="contact.html" class="nav-link">
                            Kontak
                        </a>
                    </li>
                </ul>
            </div> <!-- / .navbar-collapse -->
        </div> <!-- / .container -->
    </nav>
