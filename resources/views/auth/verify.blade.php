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
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Verifikasi link baru telah dikirimkan ke email Anda.') }}
                            </div>
                        @endif


                        <h5>{{ __('Belum Verifikasi Email!') }}</h5>
                        {{ __('Silahkan verifikasi email terlebih dahulu melalui link verifikasi yang telah kami kirim ke email Anda.') }}
                        {{ __('Jika belum menerima email verifikasi') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk meminta verifikasi kembali') }}</button>.
                        </form>
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


