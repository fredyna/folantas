<!DOCTYPE html>
<html lang="en">

@include('templates.partials._header')

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth">
          <div class="row w-100">
            <div class="col-lg-8 mx-auto">
              <div class="row justify-content-center">
                <div class="col-lg-6 bg-white">
                  <div class="auth-form-light text-left p-5">
                    <h2>Daftar</h2>
                    <h4 class="font-weight-light">Silahkan daftar untuk memulai!</h4>
                    <form class="pt-4" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}">
                          <i class="mdi mdi-account"></i>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" value="{{ old('email') }}">
                          <i class="mdi mdi-email"></i>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                            <i class="mdi mdi-lock"></i>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi password">
                            <i class="mdi mdi-lock"></i>
                        </div>

                        <div class="mt-5">
                          <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium">Daftar</button>
                        </div>
                        <div class="mt-2 text-center">
                          <a href="{{ route('login') }}" class="auth-link text-black">Sudah punya akun? <span class="font-weight-medium">Masuk</span></a>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  @include('templates.partials._footer')
</body>

</html>
