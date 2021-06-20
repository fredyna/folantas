@extends('templates.master')

@section('content')
@php
    $last_date = $last_date ? date('Y-m-d', strtotime($last_date . '- 1 day')) : date('Y-m-d', strtotime(date('Y-m-d') . '- 1 day'));
@endphp
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Data Kemacetan</li>
            </ol>
        </nav>

        <div class="row mb-4">
            <div class="col-12 text-right">
                <a href="{{ route('data-kemacetan.create') }}" class="btn btn-success">Tambah Data</a>
            </div>
        </div>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="card-title">Filter Data Kemacetan</h6>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#filter" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa fa-filter"></i> filter
                                </a>
                            </div>
                        </div>

                        <div class="row mb-3 collapse" id="filter">
                            <div class="col-md-10">
                                <div class="form-group row">
                                    <label for="jenis_laka" class="col-sm-3 col-form-label">Waktu Macet</label>
                                    <div class="col-sm-4 mb-2">
                                        <input type="date" class="form-control" id="first_date" value="{{ $first_date }}">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <input type="date" class="form-control" id="last_date" value="{{ $last_date }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="penyebab" class="col-sm-3 col-form-label">Sebab Macet</label>
                                    <div class="col-sm-9">
                                        <select name="penyebab" id="penyebab" class="form-control {{ $errors->has('penyebab') ? 'has-error':'' }}">
                                            <option value="" style="display: none;">semua</option>
                                            <option value="KECELAKAAN" {{ $penyebab == 'KECELAKAAN' ? 'selected':'' }}>KECELAKAAN</option>
                                            <option value="PENUTUPAN JALAN" {{ $penyebab == 'PENUTUPAN JALAN' ? 'selected':'' }}>PENUTUPAN JALAN</option>
                                            <option value="KERETA API" {{ $penyebab == 'KERETA API' ? 'selected':'' }}>KERETA API</option>
                                            <option value="LAINNYA" {{ $penyebab == 'LAINNYA' ? 'selected':'' }}>LAINNYA</option>
                                        </select>

                                        @if ($errors->has('penyebab'))
                                            <p class="text-danger">{{ $errors->first('penyebab') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="button" onclick="searchData()" class="btn btn-primary px-4 mr-2"><i class="fa fa-search"></i> Cari</button>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Tabel Data Kemacetan</h6>
                        <hr />

                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="table-data" class="table table-striped table-hover" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>LOKASI</th>
                                        <th>PANJANG</th>
                                        <th>SEBAB MACET</th>
                                        <th class="text-center">WAKTU</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($kemacetan) > 0)
                                        @php $no = 1; @endphp
                                       @foreach ($kemacetan as $item)
                                           <tr>
                                               <td>{{ $no++ }}</td>
                                               <td>{{ $item->lokasi }}</td>
                                               <td>{{ $item->panjang }} KM</td>
                                               <td>{{ $item->penyebab }}</td>
                                               <td class="text-center">{{ date('Y-m-d H:i:s', strtotime($item->waktu)) }}</td>
                                               <td class="text-center">
                                                   <a href="{{ route('data-kemacetan.show', $item->id) }}" class="p-1" data-toggle="tooltip" data-placement="left" title="Edit">
                                                        <i class="fa fa-edit text-success font-medium-3"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" onclick="hapusData('{{ $item->id }}')" class="p-1" data-toggle="tooltip" data-placement="right" title="Hapus">
                                                    <i class="fa fa-trash text-danger font-medium-3"></i>
                                                    </a>
                                                    <form id="data-{{ $item->id }}" action="{{ route('data-kemacetan.destroy', $item->id) }}" method="post" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                               </td>
                                           </tr>
                                       @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center"><i>Tidak ada data</i></td>
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
@endsection

@section('js')
    <script>
        $(function(){
            $("#data-kemacetan").addClass('active');
            $("#table-data").dataTable();
        });

        function hapusData(id){
          let y = confirm('Yakin mau dihapus?');
          if(y) $("#data-" + id).submit();
        }

        function searchData(){
            let first_date = $("#first_date").val();
            let last_date = $("#last_date").val();
            let penyebab = $("#penyebab").val();
            let url = "{{ route('data-kemacetan.index') }}" + "?first_date=" + first_date + "&last_date=" + last_date
                +"&penyebab=" + penyebab;

            window.location.href = url;
        }
    </script>
@endsection

