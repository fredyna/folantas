<footer class="section " id="footer">
    <div class="overlay footer-overlay"></div>
    <!--Content -->
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-lg-4 col-sm-12">
                <div class="footer-widget">
                    <!-- Brand -->
                    <a href="#" class="footer-brand text-white">
                        Folantas
                    </a>
                    <p>Folantas adalah website penyedia informasi terkini terkait situasi kecelakaan dan kemacetan di Kota Tegal.</p>
                </div>
            </div>

            <div class="col-lg-3 ml-lg-auto col-sm-12">

            </div>


            <div class="col-lg-2 col-sm-6">
                <div class="footer-widget">
                    <h3>Menu</h3>
                    <!-- Links -->
                    <ul class="footer-links ">
                        <li>
                            <a href="{{ route('home') }}">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Data Kecelakaan
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Data Kemacetan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('themes.berita') }}">
                                Berita
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                Kontak
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-sm-6">
                <div class="footer-widget">
                    <h3>Socials</h3>
                    <!-- Links -->
                    <ul class="list-unstyled footer-links">
                        <li><a href="https://web.facebook.com/" target="_blank"><i class="fab fa-facebook-f" target="_blank"></i>Facebook</a></li>
                        <!-- <li><a href="https://facebook.com"><i class="fab fa-facebook-f"></i>Facebook</a></li> -->
                        <li>
                        <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i>Instagram
                        <!-- <a href="https://twitter.com"><i class="fab fa-twitter"></i>Twitter -->
                        </a></li>
                    </ul>
                </div>
            </div>
        </div> <!-- / .row -->


        <div class="row text-right pt-5">
            <div class="col-lg-12">
                <!-- Copyright -->
                <p class="footer-copy ">
                    &copy; Copyright <span class="current-year"></span> All rights reserved.
                </p>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</footer>


    <!--  Page Scroll to Top  -->

    <a class="scroll-to-top js-scroll-trigger" href="#top-header">
        <i class="fa fa-angle-up"></i>
    </a>

    <!--
    Essential Scripts
    =====================================-->

    <!-- Main jQuery -->
    <script src="{{ asset('rappo/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.1 -->
    <script src="{{ asset('rappo/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('rappo/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('rappo/plugins/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('rappo/plugins/jquery/jquery.easing.1.3.js') }}"></script>

    <script src="{{ asset('rappo/js/theme.js') }}"></script>

    @yield('js')

  </body>
  </html>
