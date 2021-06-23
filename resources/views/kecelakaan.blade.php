@extends('templates.front.master')

@section('content')
    @include('templates.front.partials._navbar_2')

   <!-- HERO
    ================================================== -->
    <section class="page-banner-area page-about">
        <div class="overlay"></div>
        <!-- Content -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-12 col-12 text-center">
                    <div class="page-banner-content">
                        <h1 class="display-4 font-weight-bold">Data Kecelakaan</h1>
                        <p>Statistik Data Kecelakaan Lalu Lintas</p>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <section class="section" id="blog">
        <div class="container">

             <div class="row justify-content-center">
                 {{-- filter data --}}
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Filter Data Kecelakaan</h4>

                            <div class="row mb-3" id="filter">
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
                                        <label for="tkp" class="col-sm-3 col-form-label">Tampilkan Grafik</label>
                                        <div class="col-sm-9">
                                            <select name="tipe_grafik" id="tipe_grafik" class="form-control {{ $errors->has('tkp') ? 'has-error':'' }}">
                                                <option value="JENIS LAKA" {{ $tipe_grafik == 'JENIS LAKA' ? 'selected':'' }}>JENIS LAKA</option>
                                                <option value="SEBAB LAKA" {{ $tipe_grafik == 'SEBAB LAKA' ? 'selected':'' }}>SEBAB LAKA</option>
                                                <option value="TKP" {{ $tipe_grafik == 'TKP' ? 'selected':'' }}>TKP</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="button" onclick="searchData()" class="btn btn-primary py-2 px-4"><i class="fa fa-search"></i> Cari</button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                {{-- end filter data  --}}
            </div> <!-- / .row -->

            <div class="row justify-content-center mt-4">
                <div class="col-md-10">

                    @if ($tipe_grafik == 'JENIS LAKA')
                        {{-- grafik jenis laka --}}
                        <div class="row">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Grafik By Jenis Laka</h6>
                                        <div id="grafik_jenis_laka">
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
                    @elseif($tipe_grafik == 'SEBAB LAKA')
                        {{-- grafik sebab laka --}}
                        <div class="row">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Grafik By Sebab Laka</h6>
                                        <div id="grafik_sebab_laka">
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
                    @else
                        {{-- grafik tkp --}}
                        <div class="row">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Grafik By TKP</h6>
                                        <div id="grafik_tkp">
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
                    @endif



                </div>
            </div> <!-- / .row -->

        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/node_modules/chart.js/dist/Chart.min.js') }}"></script>
    @if ($tipe_grafik == 'JENIS LAKA')
    <script>
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
    </script>
    @elseif($tipe_grafik == 'SEBAB LAKA')
    <script>
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
    </script>
    @else
    <script>
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
    </script>
    @endif

    <script>
        function searchData(){
            let first_date = $("#first_date").val();
            let last_date = $("#last_date").val();
            let tipe_grafik = $("#tipe_grafik").val();
            let url = "{{ route('themes.kecelakaan') }}" + "?first_date=" + first_date + "&last_date=" + last_date
                +"&tipe_grafik=" + tipe_grafik;

            window.location.href = url;
        }
    </script>
@endsection
