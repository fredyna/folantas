@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item">Data Log</li>
            </ol>
        </nav>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Log Sistem</h6>

                        <hr />

                        <div class="table-responsive">
                            <table id="table-logs" class="table table-striped table-hover table-sm" width="100%">

                                <thead>
                                    <tr>
                                        <th width="5%" class="no-sort">No</th>
                                        <th width="15%">User</th>
                                        <th width="25%">Deskripsi</th>
                                        <th width="20%">Model</th>
                                        <th width="10%">ID Model</th>
                                        <th width="15%">Waktu</th>
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
            $("#log").addClass("active");
        });

        let log_json = "{{ route('log.json') }}";

        var table_user = $('#table-logs').DataTable({
            processing: true,
            serverSide: true,
            ajax: log_json,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'causer', name: 'causer' },
                { data: 'description', name: 'description' },
                { data: 'subject_type', name: 'subject_type' },
                { data: 'subject_id', name: 'subject_id' },
                { data: 'created_at', name: 'created_at' },
            ],
        });

        function hapusData(id){
          let y = confirm('Yakin mau dihapus?');
          if(y) $("#logs-" + id).submit();
        }

    </script>
@endsection

