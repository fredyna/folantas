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

                        <form action="{{ route('user.store') }}" method="post">
                            @csrf

                            <input id="method" type="hidden" name="method" value="post">
                            <input id="id_user" type="hidden" name="id_user">

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'has-error':'' }}" id="email" name="email" placeholder="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'has-error':'' }}" id="name" name="name" placeholder="Nama..." value="{{ old('name') }}">

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

                            <button id="btn-tambah" type="submit" class="btn btn-success mr-2">Tambah</button>
                            <button type="button" onclick="batalEdit()" class="btn btn-light">Cancel</button>
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

        let role_search = $("#role_search").val();
        let user_json = "{{ route('user.json') }}" + "?role=" + role_search;

        var table_user = $('#table-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: user_json,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'email', name: 'email' },
                { data: 'name', name: 'name' },
                { data: 'role', name: 'role' },
                { data: 'verifikasi', name: 'verifikasi', class: 'text-center' },
                { data: 'action', name: 'action', class: 'text-center' },
            ],
        });

        function editData(id, email, name, role_id){
            $("#ket-form").text('Form Edit Data User');
            $("#btn-tambah").text('Simpan');
            $("#method").val('patch');
            $("#id_user").val(id);
            $("#role").val(role_id);
            $("#email").val(email);
            $("#name").val(name);
        }

        function batalEdit(){
            $("#ket-form").text('Form Tambah Data User');
            $("#btn-tambah").text('Tambah');
            $("#method").val('post');
            $("#id_user").val("");
            $("#role").val("");
            $("#email").val("");
            $("#name").val("");
        }

        function hapusData(id){
          let y = confirm('Yakin mau dihapus?');
          if(y) $("#user-" + id).submit();
        }

        function searchData(){
            role_search = $("#role_search").val();
            user_json = "{{ route('user.json') }}" + "?role=" + role_search;
            table_user.destroy();

            table_user = $('#table-user').DataTable({
                processing: true,
                serverSide: true,
                ajax: user_json,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'email', name: 'email' },
                    { data: 'name', name: 'name' },
                    { data: 'role', name: 'role' },
                    { data: 'verifikasi', name: 'verifikasi',  class: 'text-center' },
                    { data: 'action', name: 'action', class: 'text-center' },
                ],
            });
        }
    </script>
@endsection

