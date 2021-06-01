@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <h2 class="title">Starter Page</h2>
        <nav class="bc" aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb breadcrumb-custom">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><span>Library</span></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-0">Example Card</h6>
                        <p class="card-description">What's people doing right now</p>
                        <div class="d-flex justify-content-between align-items-center">
                            Lorem ipsum dolor sit amet
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('js')
    <script src="{{ asset('assets/js/dashboard.js')}}"></script>
@endsection


