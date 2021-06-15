<!Doctype html>
<html lang="en">

@include('templates.front.partials._header')

<body id="top-header">

<!-- LOADER TEMPLATE -->
<div id="page-loader">
    <div class="loader-icon fa fa-spin colored-border"></div>
</div>
    <!-- /LOADER TEMPLATE -->

    @yield('content')

    <!-- Modal -->
    <div class="modal fade" id="modal-lapor" tabindex="-1" role="dialog" aria-labelledby="modal-lapor-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-lapor-label">Kategori Lapor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a href="#" class="btn btn-info btn-sm w-100 mb-2">Lapor Kemacetan</a>
                    <a href="#" class="btn btn-warning btn-sm w-100">Lapor Kecelakaan</a>
                </div>
            </div>
        </div>
    </div>

    @include('templates.front.partials._footer')
