@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Data Kecelakaan</li>
            </ol>
        </nav>

        <div class="row mb-4">
            <div class="col-12 text-right">
                <a href="{{ route('data-kecelakaan.create') }}" class="btn btn-success">Tambah Data</a>
            </div>
        </div>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="card-title">Filter Data Kecelakaan</h6>
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
                                    <label for="jenis_laka" class="col-sm-3 col-form-label">Jenis Laka</label>
                                    <div class="col-sm-9">
                                        <select name="jenis_laka" id="jenis_laka" class="form-control {{ $errors->has('jenis_laka') ? 'has-error':'' }}">
                                            <option value="">--pilih jenis laka--</option>
                                            <option value="TABRAK DEPAN" {{ old('jenis_laka') == 'TABRAK DEPAN' ? 'selected':'' }}>TABRAK DEPAN</option>
                                            <option value="TABRAK BELAKANG" {{ old('jenis_laka') == 'TABRAK BELAKANG' ? 'selected':'' }}>TABRAK BELAKANG</option>
                                            <option value="TABRAK SAMPING" {{ old('jenis_laka') == 'TABRAK SAMPING' ? 'selected':'' }}>TABRAK SAMPING</option>
                                            <option value="LAKA TUNGGAL" {{ old('jenis_laka') == 'LAKA TUNGGAL' ? 'selected':'' }}>LAKA TUNGGAL</option>
                                            <option value="LAKA KARAMBOL" {{ old('jenis_laka') == 'LAKA KARAMBOL' ? 'selected':'' }}>LAKA KARAMBOL</option>
                                            <option value="TABRAK LARI" {{ old('jenis_laka') == 'TABRAK LARI' ? 'selected':'' }}>TABRAK LARI</option>
                                            <option value="TABRAK MANUSIA" {{ old('jenis_laka') == 'TABRAK MANUSIA' ? 'selected':'' }}>TABRAK MANUSIA</option>
                                            <option value="TABRAK KA" {{ old('jenis_laka') == 'TABRAK KA' ? 'selected':'' }}>TABRAK KA</option>
                                        </select>

                                        @if ($errors->has('jenis_laka'))
                                            <p class="text-danger">{{ $errors->first('jenis_laka') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sebab_laka" class="col-sm-3 col-form-label">Sebab Laka</label>
                                    <div class="col-sm-9">
                                        <select name="sebab_laka" id="sebab_laka" class="form-control {{ $errors->has('sebab_laka') ? 'has-error':'' }}">
                                            <option value="">--pilih sebab laka--</option>
                                            <option value="FAKTOR MANUSIA" {{ old('sebab_laka') == 'FAKTOR MANUSIA' ? 'selected':'' }}>FAKTOR MANUSIA</option>
                                            <option value="FAKTOR KENDARAAN" {{ old('sebab_laka') == 'FAKTOR KENDARAAN' ? 'selected':'' }}>FAKTOR KENDARAAN</option>
                                            <option value="FAKTOR CUACA" {{ old('sebab_laka') == 'FAKTOR CUACA' ? 'selected':'' }}>FAKTOR CUACA</option>
                                            <option value="FAKTOR JALAN" {{ old('sebab_laka') == 'FAKTOR JALAN' ? 'selected':'' }}>FAKTOR JALAN</option>
                                            <option value="LAIN-LAIN" {{ old('sebab_laka') == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
                                        </select>

                                        @if ($errors->has('sebab_laka'))
                                            <p class="text-danger">{{ $errors->first('sebab_laka') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tkp" class="col-sm-3 col-form-label">TKP</label>
                                    <div class="col-sm-9">
                                        <select name="tkp" id="tkp" class="form-control {{ $errors->has('tkp') ? 'has-error':'' }}">
                                            <option value="">--pilih TKP--</option>
                                            <option value="JALAN UTAMA" {{ old('tkp') == 'JALAN UTAMA' ? 'selected':'' }}>JALAN UTAMA</option>
                                            <option value="JALAN KOTA" {{ old('tkp') == 'JALAN KOTA' ? 'selected':'' }}>JALAN KOTA</option>
                                            <option value="JALAN ALTERNATIF" {{ old('tkp') == 'JALAN ALTERNATIF' ? 'selected':'' }}>JALAN ALTERNATIF</option>
                                            <option value="JALAN TOL" {{ old('tkp') == 'JALAN TOL' ? 'selected':'' }}>JALAN TOL</option>
                                        </select>

                                        @if ($errors->has('tkp'))
                                            <p class="text-danger">{{ $errors->first('tkp') }}</p>
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
                        <h6 class="card-title">Tabel Data Kecelakaan</h6>
                        <hr />

                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="table-data" class="table table-striped table-hover" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>JENIS LAKA</th>
                                        <th>SEBAB LAKA</th>
                                        <th>TKP</th>
                                        <th>JK KORBAN</th>
                                        <th class="text-right">USIA KORBAN</th>
                                        <th class="text-center">WAKTU</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($kecelakaan) > 0)
                                        @php $no = 1; @endphp
                                       @foreach ($kecelakaan as $item)
                                           <tr>
                                               <td>{{ $no++ }}</td>
                                               <td>{{ $item->jenis_laka }}</td>
                                               <td>{{ $item->sebab_laka }}</td>
                                               <td>{{ $item->tkp }}</td>
                                               <td>{{ $item->jk_korban }}</td>
                                               <td class="text-right">{{ $item->usia_korban }}</td>
                                               <td class="text-center">{{ $item->waktu_laka }}</td>
                                               <td class="text-center">
                                                   <a href="{{ route('data-kecelakaan.show', $item->id) }}" class="p-1" data-toggle="tooltip" data-placement="left" title="Edit">
                                                        <i class="fa fa-edit text-success font-medium-3"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" onclick="hapusData('{{ $item->id }}')" class="p-1" data-toggle="tooltip" data-placement="right" title="Hapus">
                                                    <i class="fa fa-trash text-danger font-medium-3"></i>
                                                    </a>
                                                    <form id="data-{{ $item->id }}" action="{{ route('data-kecelakaan.destroy', $item->id) }}" method="post" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                               </td>
                                           </tr>
                                       @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center"><i>Tidak ada data</i></td>
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
            $("#data-kecelakaan").addClass('active');
            $("#table-data").dataTable();
        });

        function hapusData(id){
          let y = confirm('Yakin mau dihapus?');
          if(y) $("#data-" + id).submit();
        }

        function searchData(){
            //
        }
    </script>
@endsection

