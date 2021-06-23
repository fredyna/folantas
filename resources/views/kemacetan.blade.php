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
                        <h1 class="display-4 font-weight-bold">Data Kemacetan</h1>
                        <p>Statistik Data Kemacetan Lalu Lintas</p>
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
                            <h4 class="card-title mb-4">Filter Data Kemacetan</h4>

                            <div class="row mb-3" id="filter">
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
                <div class="col-md-10 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Grafik By Sebab Macet</h6>
                            <div id="grafik_sebab_laka">
                                <div class="row">
                                    <div class="col-md-8">
                                        <canvas id="chart-sebab-laka" style="height:250px"></canvas>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table table-hover table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Sebab Macet</th>
                                                    <th class="text-center">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>KECELAKAAN</td>
                                                    <td class="text-right">{{ $grafik_sebab['KECELAKAAN'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>PENUTUPAN JALAN</td>
                                                    <td class="text-right">{{ $grafik_sebab['PENUTUPAN JALAN'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>KERETA API</td>
                                                    <td class="text-right">{{ $grafik_sebab['KERETA API'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>LAINNYA</td>
                                                    <td class="text-right">{{ $grafik_sebab['LAINNYA'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Total Laporan</b></td>
                                                    @php
                                                        $total_sebab = $grafik_sebab['KECELAKAAN'] + $grafik_sebab['PENUTUPAN JALAN'] + $grafik_sebab['KERETA API'] + $grafik_sebab['LAINNYA'];
                                                    @endphp
                                                    <td class="text-right">{{ $total_sebab }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->

        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/node_modules/chart.js/dist/Chart.min.js') }}"></script>
    <script>

        // chart by sebab laka
        let chartSebabData = {
            datasets: [{
                data: [
                    {{ $grafik_sebab['KECELAKAAN'] }}, {{ $grafik_sebab['PENUTUPAN JALAN'] }},
                    {{ $grafik_sebab['KERETA API'] }}, {{ $grafik_sebab['LAINNYA'] }}
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
                    'KECELAKAAN', 'PENUTUPAN JALAN', 'KERETA API', 'LAINNYA'
                ]
        };
        let doughnutSebab = {
            responsive: true,
            animation: {
            animateScale: true,
            animateRotate: true
            }
        };

        let chartSebabCanvas = $("#chart-sebab-laka").get(0).getContext("2d");
        let chartSebab = new Chart(chartSebabCanvas, {
            type: 'doughnut',
            data: chartSebabData,
            options: doughnutSebab
        });
        //end chart

        function searchData(){
            let first_date = $("#first_date").val();
            let last_date = $("#last_date").val();
            let url = "{{ route('themes.kemacetan') }}" + "?first_date=" + first_date + "&last_date=" + last_date;

            window.location.href = url;
        }
    </script>
@endsection
