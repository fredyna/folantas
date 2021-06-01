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
                @if (session('status'))
                    <div class="row">
                        <div class="col-12 alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif
              <div class="row">
                <div class="col-lg-6 bg-white">
                  <div class="auth-form-light text-left p-5">
                    <h2>Masuk</h2>
                    <h4 class="font-weight-light">Silahkan masuk!</h4>
                    <form method="POST" action="{{ route('login') }}" class="pt-5">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autofocus>
                            <i class="mdi mdi-account"></i>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                            <i class="mdi mdi-eye"></i>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-5">
                          <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium">Masuk</button>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <a href="{{ route('register') }}" class="auth-link text-black">Daftar Akun Baru</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="#" class="auth-link text-black">Lupa password?</a>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
                <div class="col-lg-6 login-half-bg d-flex flex-row">
                  <p class="text-grey font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2021 All right reserved</p>
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
