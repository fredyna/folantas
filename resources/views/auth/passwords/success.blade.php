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
                <div class="row">
                    <div class="col-12 alert alert-success text-center">
                        Sukses Ubah Password! Silahkan login kembali ke aplikasi.
                    </div>
                </div>
                <br>
                <div class="col-lg-12 login-half-bg d-flex flex-row">
                  <p class="text-grey font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2020 By <a href="https://fredynurapriyanto.com">Fredy Nur Apriyanto</a></p>
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
