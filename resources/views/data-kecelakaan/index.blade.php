@extends('templates.master')

@section('content')
@php
    $last_date = $last_date ? date('Y-m-d', strtotime($last_date . '- 1 day')) : date('Y-m-d', strtotime(date('Y-m-d') . '- 1 day'));
@endphp
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

        {{-- filter data --}}
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
                                    <label for="jenis_laka" class="col-sm-3 col-form-label">Waktu Laka</label>
                                    <div class="col-sm-4 mb-2">
                                        <input type="date" class="form-control" id="first_date" value="{{ $first_date }}">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <input type="date" class="form-control" id="last_date" value="{{ $last_date }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jenis_laka" class="col-sm-3 col-form-label">Jenis Laka</label>
                                    <div class="col-sm-9">
                                        <select name="jenis_laka" id="jenis_laka" class="form-control {{ $errors->has('jenis_laka') ? 'has-error':'' }}">
                                            <option value="">semua</option>
                                            <option value="TABRAK DEPAN" {{ $jenis_laka == 'TABRAK DEPAN' ? 'selected':'' }}>TABRAK DEPAN</option>
                                            <option value="TABRAK BELAKANG" {{ $jenis_laka == 'TABRAK BELAKANG' ? 'selected':'' }}>TABRAK BELAKANG</option>
                                            <option value="TABRAK SAMPING" {{ $jenis_laka == 'TABRAK SAMPING' ? 'selected':'' }}>TABRAK SAMPING</option>
                                            <option value="LAKA TUNGGAL" {{ $jenis_laka == 'LAKA TUNGGAL' ? 'selected':'' }}>LAKA TUNGGAL</option>
                                            <option value="LAKA KARAMBOL" {{ $jenis_laka == 'LAKA KARAMBOL' ? 'selected':'' }}>LAKA KARAMBOL</option>
                                            <option value="TABRAK LARI" {{ $jenis_laka == 'TABRAK LARI' ? 'selected':'' }}>TABRAK LARI</option>
                                            <option value="TABRAK MANUSIA" {{ $jenis_laka == 'TABRAK MANUSIA' ? 'selected':'' }}>TABRAK MANUSIA</option>
                                            <option value="TABRAK KA" {{ $jenis_laka == 'TABRAK KA' ? 'selected':'' }}>TABRAK KA</option>
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
                                            <option value="">semua</option>
                                            <option value="FAKTOR MANUSIA" {{ $sebab_laka == 'FAKTOR MANUSIA' ? 'selected':'' }}>FAKTOR MANUSIA</option>
                                            <option value="FAKTOR KENDARAAN" {{ $sebab_laka == 'FAKTOR KENDARAAN' ? 'selected':'' }}>FAKTOR KENDARAAN</option>
                                            <option value="FAKTOR CUACA" {{ $sebab_laka == 'FAKTOR CUACA' ? 'selected':'' }}>FAKTOR CUACA</option>
                                            <option value="FAKTOR JALAN" {{ $sebab_laka == 'FAKTOR JALAN' ? 'selected':'' }}>FAKTOR JALAN</option>
                                            <option value="LAIN-LAIN" {{ $sebab_laka == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
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
                                            <option value="">semua</option>
                                            <option value="JALAN UTAMA" {{ $tkp == 'JALAN UTAMA' ? 'selected':'' }}>JALAN UTAMA</option>
                                            <option value="JALAN KOTA" {{ $tkp == 'JALAN KOTA' ? 'selected':'' }}>JALAN KOTA</option>
                                            <option value="JALAN ALTERNATIF" {{ $tkp == 'JALAN ALTERNATIF' ? 'selected':'' }}>JALAN ALTERNATIF</option>
                                            <option value="JALAN TOL" {{ $tkp == 'JALAN TOL' ? 'selected':'' }}>JALAN TOL</option>
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
        {{-- end filter data  --}}

        {{-- grafik jenis laka --}}
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="card-title">Grafik By Jenis Laka</h6>
                        </div>
                        <div class="col-6 text-right">
                            <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#grafik_jenis_laka" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div id="grafik_jenis_laka" class="collapse">
                        <div class="row">
                            <div class="col-md-8">
                                <canvas id="chart-jenis-laka" style="height:250px"></canvas>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Jenis Laka</th>
                                            <th class="text-center">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>TABRAK DEPAN</td>
                                            <td class="text-right">{{ $grafik_jenis_laka['TABRAK DEPAN'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>TABRAK BELAKANG</td>
                                            <td class="text-right">{{ $grafik_jenis_laka['TABRAK BELAKANG'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>TABRAK SAMPING</td>
                                            <td class="text-right">{{ $grafik_jenis_laka['TABRAK SAMPING'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>LAKA TUNGGAL</td>
                                            <td class="text-right">{{ $grafik_jenis_laka['LAKA TUNGGAL'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>LAKA KRAMBOL</td>
                                            <td class="text-right">{{ $grafik_jenis_laka['LAKA KRAMBOL'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>TABRAK LARI</td>
                                            <td class="text-right">{{ $grafik_jenis_laka['TABRAK LARI'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>TABRAK MANUSIA</td>
                                            <td class="text-right">{{ $grafik_jenis_laka['TABRAK MANUSIA'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>TABRAK KA</td>
                                            <td class="text-right">{{ $grafik_jenis_laka['TABRAK KA'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Laporan</b></td>
                                            @php
                                                $total_jenis_laka = $grafik_jenis_laka['TABRAK DEPAN'] + $grafik_jenis_laka['TABRAK BELAKANG'] + $grafik_jenis_laka['TABRAK SAMPING'] + $grafik_jenis_laka['LAKA TUNGGAL'] + $grafik_jenis_laka['LAKA KRAMBOL'] + $grafik_jenis_laka['TABRAK LARI'] + $grafik_jenis_laka['TABRAK MANUSIA'] + $grafik_jenis_laka['TABRAK KA'];
                                            @endphp
                                            <td class="text-right">{{ $total_jenis_laka }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        {{-- end grafik jenis laka --}}

        {{-- grafik sebab laka --}}
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="card-title">Grafik By Sebab Laka</h6>
                        </div>
                        <div class="col-6 text-right">
                            <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#grafik_sebab_laka" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div id="grafik_sebab_laka" class="collapse">
                        <div class="row">
                            <div class="col-md-8">
                                <canvas id="chart-sebab-laka" style="height:250px"></canvas>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sebab Laka</th>
                                            <th class="text-center">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>FAKTOR MANUSIA</td>
                                            <td class="text-right">{{ $grafik_sebab_laka['FAKTOR MANUSIA'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>FAKTOR KENDARAAN</td>
                                            <td class="text-right">{{ $grafik_sebab_laka['FAKTOR KENDARAAN'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>FAKTOR CUACA</td>
                                            <td class="text-right">{{ $grafik_sebab_laka['FAKTOR CUACA'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>FAKTOR JALAN</td>
                                            <td class="text-right">{{ $grafik_sebab_laka['FAKTOR JALAN'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>LAIN-LAIN</td>
                                            <td class="text-right">{{ $grafik_sebab_laka['LAIN-LAIN'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Laporan</b></td>
                                            @php
                                                $total_sebab_laka = $grafik_sebab_laka['FAKTOR MANUSIA'] + $grafik_sebab_laka['FAKTOR KENDARAAN'] + $grafik_sebab_laka['FAKTOR CUACA'] + $grafik_sebab_laka['FAKTOR JALAN'] + $grafik_sebab_laka['LAIN-LAIN'];
                                            @endphp
                                            <td class="text-right">{{ $total_sebab_laka }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        {{-- end grafik sebab laka --}}

        {{-- grafik tkp --}}
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="card-title">Grafik By TKP</h6>
                        </div>
                        <div class="col-6 text-right">
                            <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#grafik_tkp" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div id="grafik_tkp" class="collapse">
                        <div class="row">
                            <div class="col-md-8">
                                <canvas id="chart-tkp" style="height:250px"></canvas>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>TKP</th>
                                            <th class="text-center">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>JALAN UTAMA</td>
                                            <td class="text-right">{{ $grafik_tkp['JALAN UTAMA'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>JALAN KOTA</td>
                                            <td class="text-right">{{ $grafik_tkp['JALAN KOTA'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>JALAN ALTERNATIF</td>
                                            <td class="text-right">{{ $grafik_tkp['JALAN ALTERNATIF'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>JALAN TOL</td>
                                            <td class="text-right">{{ $grafik_tkp['JALAN TOL'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Laporan</b></td>
                                            @php
                                                $total_tkp = $grafik_tkp['JALAN UTAMA'] + $grafik_tkp['JALAN KOTA'] + $grafik_tkp['JALAN ALTERNATIF'] + $grafik_tkp['JALAN TOL'];
                                            @endphp
                                            <td class="text-right">{{ $total_tkp }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        {{-- end grafik sebab laka --}}

        {{-- tabel data  --}}
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
                            <table id="{{ count($kecelakaan) > 0 ? 'table-data':'' }}" class="table table-striped table-hover" width="100%">
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
                                               <td class="text-right">{{ $item->usia_korban }} TAHUN</td>
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
        {{-- end tabel data  --}}
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('js')
    <script src="{{ asset('assets/js/dashboard.js')}}"></script>
    <script>
        $(function(){
            $("#data-kecelakaan").addClass('active');
            $("#table-data").dataTable();
        });

        // chart by jenis laka
        let chartJenisData = {
            datasets: [{
                data: [
                    {{ $grafik_jenis_laka['TABRAK DEPAN'] }}, {{ $grafik_jenis_laka['TABRAK BELAKANG'] }},
                    {{ $grafik_jenis_laka['TABRAK SAMPING'] }}, {{ $grafik_jenis_laka['LAKA TUNGGAL'] }},
                    {{ $grafik_jenis_laka['LAKA KRAMBOL'] }}, {{ $grafik_jenis_laka['TABRAK LARI'] }},
                    {{ $grafik_jenis_laka['TABRAK MANUSIA'] }}, {{ $grafik_jenis_laka['TABRAK KA'] }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(153, 51, 153, 0.5)',
                    'rgba(51, 51, 204, 0.5)',
                    'rgba(0, 255, 153, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 51, 153, 1)',
                    'rgba(51, 51, 204, 1)',
                    'rgba(0, 255, 153, 1)'
                ],
            }],
            labels: [
                    'TABRAK DEPAN', 'TABRAK BELAKANG', 'TABRAK SAMPING', 'LAKA TUNGGAL',
                    'LAKA KRAMBOL', 'TABRAK LARI', 'TABRAK MANUSIA', 'TABRAK KA'
                ]
        };
        let doughnutJenisLaka = {
            responsive: true,
            animation: {
            animateScale: true,
            animateRotate: true
            }
        };

        let chartJenisCanvas = $("#chart-jenis-laka").get(0).getContext("2d");
        let chartJenisLaka = new Chart(chartJenisCanvas, {
            type: 'doughnut',
            data: chartJenisData,
            options: doughnutJenisLaka
        });
        //end chart

        // chart by sebab laka
        let chartSebabData = {
            datasets: [{
                data: [
                    {{ $grafik_sebab_laka['FAKTOR MANUSIA'] }}, {{ $grafik_sebab_laka['FAKTOR KENDARAAN'] }},
                    {{ $grafik_sebab_laka['FAKTOR CUACA'] }}, {{ $grafik_sebab_laka['FAKTOR JALAN'] }},
                    {{ $grafik_sebab_laka['LAIN-LAIN'] }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
            }],
            labels: [
                    'FAKTOR MANUSIA', 'FAKTOR KENDARAAN', 'FAKTOR CUACA', 'FAKTOR JALAN',
                    'LAIN-LAIN'
                ]
        };
        let doughnutSebabLaka = {
            responsive: true,
            animation: {
            animateScale: true,
            animateRotate: true
            }
        };

        let chartSebabCanvas = $("#chart-sebab-laka").get(0).getContext("2d");
        let chartSebabLaka = new Chart(chartSebabCanvas, {
            type: 'doughnut',
            data: chartSebabData,
            options: doughnutSebabLaka
        });
        //end chart

        // chart by tkp
        let chartTKPData = {
            datasets: [{
                data: [
                    {{ $grafik_tkp['JALAN UTAMA'] }}, {{ $grafik_tkp['JALAN KOTA'] }},
                    {{ $grafik_tkp['JALAN ALTERNATIF'] }}, {{ $grafik_tkp['JALAN TOL'] }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                ],
            }],
            labels: [
                    'JALAN UTAMA', 'JALAN KOTA', 'JALAN ALTERNATIF', 'JALAN TOL'
                ]
        };
        let doughnutTKP = {
            responsive: true,
            animation: {
            animateScale: true,
            animateRotate: true
            }
        };

        let chartTKPCanvas = $("#chart-tkp").get(0).getContext("2d");
        let chartTKP = new Chart(chartTKPCanvas, {
            type: 'doughnut',
            data: chartTKPData,
            options: doughnutTKP
        });
        //end chart

        function hapusData(id){
          let y = confirm('Yakin mau dihapus?');
          if(y) $("#data-" + id).submit();
        }

        function searchData(){
            let first_date = $("#first_date").val();
            let last_date = $("#last_date").val();
            let jenis_laka = $("#jenis_laka").val();
            let sebab_laka = $("#sebab_laka").val();
            let tkp = $("#tkp").val();
            let url = "{{ route('data-kecelakaan.index') }}" + "?first_date=" + first_date + "&last_date=" + last_date
                +"&jenis_laka=" + jenis_laka + "&sebab_laka=" + sebab_laka + "&tkp=" + tkp;

            window.location.href = url;
        }
    </script>
@endsection

