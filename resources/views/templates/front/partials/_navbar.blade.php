<div class="logo-bar d-none d-md-block d-lg-block bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="logo d-none d-lg-block">
                    <!-- Brand -->
                    <a class="navbar-brand js-scroll-trigger" href="{{ route('home') }}">
                        <h2>FOLANTAS</h2>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 justify-content-end ml-lg-auto d-flex col-12 col-md-12 justify-content-md-center">
                <div class="top-info-block d-inline-flex">
                    <div class="icon-block">
                        <i class="ti-mobile"></i>
                    </div>
                    <div class="info-block">
                        <h5 class="font-weight-500">+7809346657</h5>
                        <p>Telepon</p>
                    </div>
                </div>
                <div class="top-info-block d-inline-flex">
                    <div class="icon-block">
                        <i class="ti-email"></i>
                    </div>
                    <div class="info-block">
                        <h5 class="font-weight-500">info@example.com</h5>
                        <p>Email</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- NAVBAR
================================================= -->
<div class="main-navigation" id="mainmenu-area">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary main-nav navbar-togglable rounded-radius">

            <a class="navbar-brand d-lg-none d-block" href="">
                <h4>Folantas</h4>
            </a>
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>

            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Links -->
                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a href="{{ route('home') }}" class="nav-link js-scroll-trigger">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link js-scroll-trigger">
                            Data Kecelakaan
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link js-scroll-trigger">
                            Data Kemacetan
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="pricing.html" class="nav-link js-scroll-trigger">
                            Berita
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="contact.html" class="nav-link">
                            Kontak
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="{{ route('login') }}" class="nav-link">
                            Masuk
                        </a>
                    </li>
                </ul>

                <ul class="ml-lg-auto list-unstyled m-0">
                    <li>
                        <a href="#" class="btn btn-white btn-circled" style="font-size: 1em;" data-toggle="modal" data-target="#modal-lapor">
                            <i class="ti-alert"></i> Lapor
                        </a>
                    </li>
                </ul>
            </div> <!-- / .navbar-collapse -->
        </nav>
    </div> <!-- / .container -->
</div>

