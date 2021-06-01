@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-md-center">
                        <div class="ml-3 mt-3">
                            <div class="col-sm-4 offset-4">
                                <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo" class="img-fluid">
                            </div>
                            <h3 class="text-center mt-4">APLIKASI INFO LALU LINTAS</h3>
                            <p class="text-center">Made with Love <i class="mdi mdi-heart text-danger"></i> &copy; 2021 All right reserved</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->

@endsection

@section('js')
    <script>
        $(function(){
            $("#dashboard").addClass('active');
        });
    </script>
@endsection


