@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Data User</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Form User</h6>
                        <p id="ket-form" class="card-description">Form Tambah Data User</p>
                        <hr />

                        <form action="{{ route('user.store') }}" method="post">
                            @csrf

                            <input id="method" type="hidden" name="method" value="post">
                            <input id="id_user" type="hidden" name="id_user">

                            @if (Auth()->user()->role_id == 1)
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control {{ $errors->has('role') ? 'has-error':'' }}">
                                        <option value="">--pilih role--</option>
                                        @if (!empty($roles))
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->id == old('role') ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('role'))
                                        <p class="text-danger">{{ $errors->first('role') }}</p>
                                    @endif
                                </div>
                            @else
                                <input type="hidden" name="role" value="3">
                            @endif

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control {{ $errors->has('username') ? 'has-error':'' }}" id="username" name="username" placeholder="Username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <p class="text-danger">{{ $errors->first('username') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'has-error':'' }}" id="name" name="name" placeholder="Nama..." value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">No HP</label>
                                <input type="tel" class="form-control {{ $errors->has('phone') ? 'has-error':'' }}" id="phone" name="phone" placeholder="Nama..." value="{{ old('name') }}">

                                @if ($errors->has('phone'))
                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                @endif
                            </div>

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

            <div class="col-md-8 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data User</h6>
                        <hr />

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select id="role_search" class="form-control">
                                            @if (Auth()->user()->role_id == 1)
                                                <option value="">Semua</option>
                                                @if (!empty($roles))
                                                    @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $role->id == old('role') ? 'selected' : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                @endif
                                            @else
                                                <option value="3">Sopir Ambulans</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select id="status_search" class="form-control">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-primary" onclick="searchData()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>


                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="table-user" class="table table-striped table-hover table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
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
            $("#user").addClass('active');
        });

        let role_search = $("#role_search").val();
        let status_search = $("#status_search").val();
        let user_json = "{{ route('user.json') }}" + "?role=" + role_search + "&status=" + status_search;

        var table_user = $('#table-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: user_json,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'username', name: 'username' },
                { data: 'name', name: 'name' },
                { data: 'role', name: 'role' },
                { data: 'status', name: 'status', class: 'text-center' },
                { data: 'action', name: 'action', class: 'text-center' },
            ],
        });

        function editData(id, username, name, role_id, phone){
            $("#ket-form").text('Form Edit Data User');
            $("#btn-tambah").text('Simpan');
            $("#method").val('patch');
            $("#id_user").val(id);
            $("#role").val(role_id);
            $("#username").val(username);
            $("#name").val(name);
            $("#phone").val(phone);
        }

        function batalEdit(){
            $("#ket-form").text('Form Tambah Data User');
            $("#btn-tambah").text('Tambah');
            $("#method").val('post');
            $("#id_user").val("");
            $("#role").val("");
            $("#username").val("");
            $("#name").val("");
            $("#phone").val("");
        }

        function hapusData(id){
          let y = confirm('Yakin mau dihapus?');
          if(y) $("#user-" + id).submit();
        }

        function activated(url){
            axios.get(url)
            .then(function (response) {
                $.toast({
                    heading: 'Berhasil!',
                    text: 'Berhasil menyimpan perubahan',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'top-right'
                });

                table_user.ajax.reload(null, false);
            })
            .catch(function (error) {
                $.toast({
                    heading: 'Gagal!',
                    text: 'Gagal menyimpan perubahan',
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f96868',
                    position: 'top-right'
                });
            });
        }

        function searchData(){
            role_search = $("#role_search").val();
            status_search = $("#status_search").val();
            user_json = "{{ route('user.json') }}" + "?role=" + role_search + "&status=" + status_search;
            table_user.destroy();

            table_user = $('#table-user').DataTable({
                processing: true,
                serverSide: true,
                ajax: user_json,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'username', name: 'username' },
                    { data: 'name', name: 'name' },
                    { data: 'role', name: 'role' },
                    { data: 'status', name: 'status', class: 'text-center' },
                    { data: 'action', name: 'action', class: 'text-center' },
                ],
            });
        }
    </script>
@endsection

