@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Laporan Kecelakaan</li>
            </ol>
        </nav>

        <div class="row mb-4">
            <div class="col-12 text-right">
                <a href="{{ route('lapor-kecelakaan.create') }}" class="btn btn-success">Tambah Data</a>
            </div>
        </div>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Tabel Data Laporan Kecelakaan</h6>
                        <hr />

                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="{{ count($laporan) > 0 ? 'table-data':'' }}" class="table table-striped table-hover" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>JUDUL</th>
                                        <th>FOTO</th>
                                        <th width="30%">DESKRIPSI</th>
                                        @if (Auth()->user()->role_id == 1)
                                        <th>USER</th>
                                        @endif
                                        <th class="text-center" width="15%">WAKTU</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($laporan) > 0)
                                        @php $no = 1; @endphp
                                       @foreach ($laporan as $item)
                                           <tr>
                                               <td>{{ $no++ }}</td>
                                               <td>{{ Str::limit($item->judul, 100, '...') }}</td>
                                               <td class="text-center">
                                                   <a href="{{ asset('berkas/laporan/' . $item->foto) }}" target="_blank">
                                                        <img src="{{ asset('berkas/laporan/' . $item->foto) }}" alt="Foto" class="mx-auto d-block">
                                                   </a>
                                               </td>
                                               <td>{!! Str::limit(strip_tags($item->deskripsi), 100, '...') !!}</td>
                                               @if (Auth()->user()->role_id == 1)
                                               <td>{{ $item->user->name }}</td>
                                               @endif
                                               <td class="text-center">{{ $item->created_at }}</td>
                                               <td class="text-center">
                                                   <a href="{{ route('lapor-kecelakaan.show', $item->id) }}" class="p-1" data-toggle="tooltip" data-placement="left" title="Edit">
                                                        <i class="fa fa-edit text-success font-medium-3"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" onclick="hapusData('{{ $item->id }}')" class="p-1" data-toggle="tooltip" data-placement="right" title="Hapus">
                                                    <i class="fa fa-trash text-danger font-medium-3"></i>
                                                    </a>
                                                    <form id="data-{{ $item->id }}" action="{{ route('lapor-kecelakaan.destroy', $item->id) }}" method="post" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                               </td>
                                           </tr>
                                       @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center"><i>Tidak ada data</i></td>
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
            $("#data-laporan").addClass("active");
            $("#data-laporan .collapse").addClass("show");
            $("#lapor-kecelakaan").addClass("active");
            $("#table-data").dataTable();
        });

        function hapusData(id){
          let y = confirm('Yakin mau dihapus?');
          if(y) $("#data-" + id).submit();
        }
    </script>
@endsection

