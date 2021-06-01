@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Data Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-sm-6 offset-sm-3 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Role User</h6>
                        <p class="card-description">Data master role user</p>

                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="{{ !empty($roles) && count($roles) > 10 ? 'table-role':'' }}" class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($roles))
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->description }}</td>
                                                <td class="text-center">
                                                <a href="javascript:void(0)" onclick="showForm('{{$role->id}}', '{{$role->name}}', '{{$role->description}}', '{{ route('role.update', $role->id) }}')" class="btn social-btn btn-linkedin btn-rounded p-1" data-original-title="" data-toggle="tooltip" data-placement="left" title="Edit">
                                                        <i class="fa fa-pencil font-medium-3"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center"><i>Tidak Ada Data</i></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->

    {{-- modal --}}
    @include('templates.partials.modals._formRole')
@endsection

@section('js')
    <script>
        $(function(){
            $("#master").addClass("active");
            $("#master .collapse").addClass("show");
            $("#master-role").addClass("active");

            $("#table-role").dataTable({
                responsive: true,
                "columnDefs": [ {
                "targets": 0,
                "orderable": false
                } ]
            });

            $("#btn-simpan").click(function(){
                let url = $('#url').val();
                let name = $('#name').val();
                let description = $('#description').val();
                $('#form-input-role').attr('action', url);

                if(name == '') {
                    swal('Oopss!', 'Nama role masih kosong!', 'error');
                    return false;
                }
                if(description == '') {
                    swal('Oopss!', 'Deskripsi masih kosong!', 'error');
                    return false;
                }

                $('#form-input-role').submit();
            });
        });

        function showForm(id, name, description, url){
            clearForm();
            $('#id').val(id);
            $('#url').val(url);
            $('#name').val(name);
            $('#description').val(description);
            $('#form-role').modal('show');
        }

        function clearForm(){
            $('#id').val('');
            $('#name').val('');
            $('#description').text('');
        }
    </script>
@endsection

