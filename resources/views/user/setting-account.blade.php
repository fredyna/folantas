@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Akun</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Detail Akun</h6>
                        <p id="ket-form" class="card-description">Form Setting Data User</p>
                        <hr />

                        <form action="{{ route('setting.account') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'has-error':'' }}" id="email" name="email" placeholder="email" value="{{ Auth::user()->email }}">

                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'has-error':'' }}" id="name" name="name" placeholder="Nama..." value="{{ Auth::user()->name }}">

                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <p class="mt-4 mb-4"><span class="text-danger">*</span>) Jika tidak ingin mengganti password, kosongkan saja!</p>

                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? 'has-error':'' }}" id="password" name="password" placeholder="Password">

                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="r_password">Ulang Password</label>
                                <input type="password" class="form-control {{ $errors->has('r_password') ? 'has-error':'' }}" id="r_password" name="r_password" placeholder="Ulang Password">
                                @if ($errors->has('r_password'))
                                    <p class="text-danger">{{ $errors->first('r_password') }}</p>
                                @endif
                            </div>

                            <button id="btn-tambah" type="submit" class="btn btn-success px-4 float-right">Simpan</button>
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
            $("#user").addClass('active');
        });
    </script>
@endsection

