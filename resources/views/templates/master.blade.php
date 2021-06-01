<!DOCTYPE html>
<html lang="en">

    @include('templates.partials._header')

    <body class="sidebar-dark">
        <div class="container-scroller">

            @include('templates.partials._navbar')

            <div class="container-fluid page-body-wrapper">
                <div class="row row-offcanvas row-offcanvas-right">

                    {{-- @include('templates.partials._settings') --}}
                    @if (Auth::user()->email_verified_at)
                        @include('templates.partials.sidebar._sidebar')
                    @else
                        @include('templates.partials.sidebar._sidebar_not_verified')
                    @endif
                    @yield('content')
                    @include('templates.partials._copyright')

                </div>
                <!-- row-offcanvas ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        @include('templates.partials._footer')

    </body>
</html>
