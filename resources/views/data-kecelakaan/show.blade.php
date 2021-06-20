@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" jenis_laka="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Data Kecelakaan</li>
            </ol>
        </nav>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Form Data Kecelakaan</h6>
                        <hr />

                        <form action="{{ route('data-kecelakaan.update', $kecelakaan->id) }}" method="post">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="jenis_laka" class="col-sm-3 col-form-label">Jenis Laka</label>
                                <div class="col-sm-9">
                                    <select name="jenis_laka" id="jenis_laka" class="form-control {{ $errors->has('jenis_laka') ? 'has-error':'' }}">
                                        <option value="">--pilih jenis laka--</option>
                                        <option value="TABRAK DEPAN" {{ $kecelakaan->jenis_laka == 'TABRAK DEPAN' ? 'selected':'' }}>TABRAK DEPAN</option>
                                        <option value="TABRAK BELAKANG" {{ $kecelakaan->jenis_laka == 'TABRAK BELAKANG' ? 'selected':'' }}>TABRAK BELAKANG</option>
                                        <option value="TABRAK SAMPING" {{ $kecelakaan->jenis_laka == 'TABRAK SAMPING' ? 'selected':'' }}>TABRAK SAMPING</option>
                                        <option value="LAKA TUNGGAL" {{ $kecelakaan->jenis_laka == 'LAKA TUNGGAL' ? 'selected':'' }}>LAKA TUNGGAL</option>
                                        <option value="LAKA KARAMBOL" {{ $kecelakaan->jenis_laka == 'LAKA KARAMBOL' ? 'selected':'' }}>LAKA KARAMBOL</option>
                                        <option value="TABRAK LARI" {{ $kecelakaan->jenis_laka == 'TABRAK LARI' ? 'selected':'' }}>TABRAK LARI</option>
                                        <option value="TABRAK MANUSIA" {{ $kecelakaan->jenis_laka == 'TABRAK MANUSIA' ? 'selected':'' }}>TABRAK MANUSIA</option>
                                        <option value="TABRAK KA" {{ $kecelakaan->jenis_laka == 'TABRAK KA' ? 'selected':'' }}>TABRAK KA</option>
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
                                        <option value="FAKTOR MANUSIA" {{ $kecelakaan->sebab_laka == 'FAKTOR MANUSIA' ? 'selected':'' }}>FAKTOR MANUSIA</option>
                                        <option value="FAKTOR KENDARAAN" {{ $kecelakaan->sebab_laka == 'FAKTOR KENDARAAN' ? 'selected':'' }}>FAKTOR KENDARAAN</option>
                                        <option value="FAKTOR CUACA" {{ $kecelakaan->sebab_laka == 'FAKTOR CUACA' ? 'selected':'' }}>FAKTOR CUACA</option>
                                        <option value="FAKTOR JALAN" {{ $kecelakaan->sebab_laka == 'FAKTOR JALAN' ? 'selected':'' }}>FAKTOR JALAN</option>
                                        <option value="LAIN-LAIN" {{ $kecelakaan->sebab_laka == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
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
                                        <option value="JALAN UTAMA" {{ $kecelakaan->tkp == 'JALAN UTAMA' ? 'selected':'' }}>JALAN UTAMA</option>
                                        <option value="JALAN KOTA" {{ $kecelakaan->tkp == 'JALAN KOTA' ? 'selected':'' }}>JALAN KOTA</option>
                                        <option value="JALAN ALTERNATIF" {{ $kecelakaan->tkp == 'JALAN ALTERNATIF' ? 'selected':'' }}>JALAN ALTERNATIF</option>
                                        <option value="JALAN TOL" {{ $kecelakaan->tkp == 'JALAN TOL' ? 'selected':'' }}>JALAN TOL</option>
                                    </select>

                                    @if ($errors->has('tkp'))
                                        <p class="text-danger">{{ $errors->first('tkp') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <select name="hari" id="hari" class="form-control {{ $errors->has('hari') ? 'has-error':'' }}">
                                        <option value="">--pilih hari--</option>
                                        <option value="SENIN" {{ $kecelakaan->hari == 'SENIN' ? 'selected':'' }}>SENIN</option>
                                        <option value="SELASA" {{ $kecelakaan->hari == 'SELASA' ? 'selected':'' }}>SELASA</option>
                                        <option value="RABU" {{ $kecelakaan->hari == 'RABU' ? 'selected':'' }}>RABU</option>
                                        <option value="KAMIS" {{ $kecelakaan->hari == 'KAMIS' ? 'selected':'' }}>KAMIS</option>
                                        <option value="JUMAT" {{ $kecelakaan->hari == 'JUMAT' ? 'selected':'' }}>JUMAT</option>
                                        <option value="SABTU" {{ $kecelakaan->hari == 'SABTU' ? 'selected':'' }}>SABTU</option>
                                        <option value="MINGGU" {{ $kecelakaan->hari == 'MINGGU' ? 'selected':'' }}>MINGGU</option>
                                    </select>

                                    @if ($errors->has('hari'))
                                        <p class="text-danger">{{ $errors->first('hari') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                @php
                                    $tanggal = date('Y-m-d', strtotime($kecelakaan->waktu_laka));
                                    $jam = date('H', strtotime($kecelakaan->waktu_laka));
                                    $menit = date('i', strtotime($kecelakaan->waktu_laka));
                                    $detik = date('s', strtotime($kecelakaan->waktu_laka));
                                @endphp
                                <label for="waktu_laka" class="col-sm-3 col-form-label">Waktu Kejadian</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control {{ $errors->has('waktu_laka') ? 'has-error':'' }}" id="waktu_laka" name="waktu_laka"  value="{{ $tanggal }}">
                                </div>
                                <div class="col-md-1">
                                    <select name="jam" id="jam" class="form-control">
                                        @for ($i = 0; $i < 60; $i++)
                                            <option value="{{ $i }}" {{ $jam == $i ? 'selected':'' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <select name="menit" id="menit" class="form-control">
                                        @for ($i = 0; $i < 60; $i++)
                                            <option value="{{ $i }}" {{ $menit == $i ? 'selected':'' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <select name="detik" id="detik" class="form-control">
                                        @for ($i = 0; $i < 60; $i++)
                                            <option value="{{ $i }}" {{ $detik == $i ? 'selected':'' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-9 offset-md-3">
                                    @if ($errors->has('waktu_laka'))
                                        <p class="text-danger">{{ $errors->first('waktu_laka') }}</p>
                                    @endif

                                    @if ($errors->has('jam'))
                                        <p class="text-danger">{{ $errors->first('jam') }}</p>
                                    @endif

                                    @if ($errors->has('menit'))
                                        <p class="text-danger">{{ $errors->first('menit') }}</p>
                                    @endif

                                    @if ($errors->has('detik'))
                                        <p class="text-danger">{{ $errors->first('detik') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kendaraan_terlibat" class="col-sm-3 col-form-label">Kendaraan Terlibat</label>
                                <div class="col-sm-9">
                                    <select name="kendaraan_terlibat" id="kendaraan_terlibat" class="form-control {{ $errors->has('kendaraan_terlibat') ? 'has-error':'' }}">
                                        <option value="">--pilih kendaraan terlibat--</option>
                                        <option value="MOBIL PRIBADI" {{ $kecelakaan->kendaraan_terlibat == 'MOBIL PRIBADI' ? 'selected':'' }}>MOBIL PRIBADI</option>
                                        <option value="MOBIL BEBAN" {{ $kecelakaan->kendaraan_terlibat == 'MOBIL BEBAN' ? 'selected':'' }}>MOBIL BEBAN</option>
                                        <option value="MOBIL PENUMPANG" {{ $kecelakaan->kendaraan_terlibat == 'MOBIL PENUMPANG' ? 'selected':'' }}>MOBIL PENUMPANG</option>
                                        <option value="BUS" {{ $kecelakaan->kendaraan_terlibat == 'BUS' ? 'selected':'' }}>BUS</option>
                                        <option value="SEPEDA MOTOR" {{ $kecelakaan->kendaraan_terlibat == 'SEPEDA MOTOR' ? 'selected':'' }}>SEPEDA MOTOR</option>
                                        <option value="RAN TIDAK BERMOTOR" {{ $kecelakaan->kendaraan_terlibat == 'RAN TIDAK BERMOTOR' ? 'selected':'' }}>RAN TIDAK BERMOTOR</option>
                                        <option value="KA" {{ $kecelakaan->kendaraan_terlibat == 'KA' ? 'selected':'' }}>KA</option>
                                    </select>

                                    @if ($errors->has('kendaraan_terlibat'))
                                        <p class="text-danger">{{ $errors->first('kendaraan_terlibat') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jk_korban" class="col-sm-3 col-form-label">Jenis Kelamin Korban</label>
                                <div class="col-sm-9">
                                    <select name="jk_korban" id="jk_korban" class="form-control {{ $errors->has('jk_korban') ? 'has-error':'' }}">
                                        <option value="">--pilih jeni kelamin--</option>
                                        <option value="LAKI-LAKI" {{ $kecelakaan->jk_korban == 'LAKI-LAKI' ? 'selected':'' }}>LAKI-LAKI</option>
                                        <option value="PEREMPUAN" {{ $kecelakaan->jk_korban == 'PEREMPUAN' ? 'selected':'' }}>PEREMPUAN</option>
                                    </select>

                                    @if ($errors->has('jk_korban'))
                                        <p class="text-danger">{{ $errors->first('jk_korban') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="usia_korban" class="col-sm-3 col-form-label">Usia Korban</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control {{ $errors->has('usia_korban') ? 'has-error':'' }}" id="usia_korban" name="usia_korban" value="{{ $kecelakaan->usia_korban }}">

                                    @if ($errors->has('usia_korban'))
                                        <p class="text-danger">{{ $errors->first('usia_korban') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profesi_korban" class="col-sm-3 col-form-label">Profesi Korban</label>
                                <div class="col-sm-9">
                                    <select name="profesi_korban" id="profesi_korban" class="form-control {{ $errors->has('profesi_korban') ? 'has-error':'' }}">
                                        <option value="">--pilih profesi--</option>
                                        <option value="TNI/POLRI/PNS" {{ $kecelakaan->profesi_korban == 'TNI/POLRI/PNS' ? 'selected':'' }}>TNI/POLRI/PNS</option>
                                        <option value="SWASTA" {{ $kecelakaan->profesi_korban == 'SWASTA' ? 'selected':'' }}>SWASTA</option>
                                        <option value="PENGEMUDI" {{ $kecelakaan->profesi_korban == 'PENGEMUDI' ? 'selected':'' }}>PENGEMUDI</option>
                                        <option value="PELAJAR/MAHASISWA" {{ $kecelakaan->profesi_korban == 'PELAJAR/MAHASISWA' ? 'selected':'' }}>PELAJAR/MAHASISWA</option>
                                        <option value="BURUH/TANI" {{ $kecelakaan->profesi_korban == 'BURUH/TANI' ? 'selected':'' }}>BURUH/TANI</option>
                                        <option value="LAIN-LAIN" {{ $kecelakaan->profesi_korban == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
                                    </select>

                                    @if ($errors->has('profesi_korban'))
                                        <p class="text-danger">{{ $errors->first('profesi_korban') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pendidikan_korban" class="col-sm-3 col-form-label">Pendidikan Korban</label>
                                <div class="col-sm-9">
                                    <select name="pendidikan_korban" id="pendidikan_korban" class="form-control {{ $errors->has('pendidikan_korban') ? 'has-error':'' }}">
                                        <option value="">--pilih pendidikan--</option>
                                        <option value="PT" {{ $kecelakaan->pendidikan_korban == 'PT' ? 'selected':'' }}>PT</option>
                                        <option value="SLTA" {{ $kecelakaan->pendidikan_korban == 'SLTA' ? 'selected':'' }}>SLTA</option>
                                        <option value="SLTP" {{ $kecelakaan->pendidikan_korban == 'SLTP' ? 'selected':'' }}>SLTP</option>
                                        <option value="SD" {{ $kecelakaan->pendidikan_korban == 'SD' ? 'selected':'' }}>SD</option>
                                        <option value="LAIN-LAIN" {{ $kecelakaan->pendidikan_korban == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
                                    </select>

                                    @if ($errors->has('pendidikan_korban'))
                                        <p class="text-danger">{{ $errors->first('pendidikan_korban') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sim_korban" class="col-sm-3 col-form-label">SIM Korban</label>
                                <div class="col-sm-9">
                                    <select name="sim_korban" id="sim_korban" class="form-control {{ $errors->has('sim_korban') ? 'has-error':'' }}">
                                        <option value="">--pilih sim--</option>
                                        <option value="A" {{ $kecelakaan->sim_korban == 'A' ? 'selected':'' }}>A</option>
                                        <option value="AU" {{ $kecelakaan->sim_korban == 'AU' ? 'selected':'' }}>AU</option>
                                        <option value="BI" {{ $kecelakaan->sim_korban == 'BI' ? 'selected':'' }}>BI</option>
                                        <option value="BI U" {{ $kecelakaan->sim_korban == 'BI U' ? 'selected':'' }}>BI U</option>
                                        <option value="BII" {{ $kecelakaan->sim_korban == 'BII' ? 'selected':'' }}>BII</option>
                                        <option value="BII U" {{ $kecelakaan->sim_korban == 'BII U' ? 'selected':'' }}>BII U</option>
                                        <option value="C" {{ $kecelakaan->sim_korban == 'C' ? 'selected':'' }}>C</option>
                                        <option value="TANPA SIM" {{ $kecelakaan->sim_korban == 'TANPA SIM' ? 'selected':'' }}>TANPA SIM</option>
                                    </select>

                                    @if ($errors->has('sim_korban'))
                                        <p class="text-danger">{{ $errors->first('sim_korban') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jk_pelaku" class="col-sm-3 col-form-label">Jenis Kelamin Pelaku</label>
                                <div class="col-sm-9">
                                    <select name="jk_pelaku" id="jk_pelaku" class="form-control {{ $errors->has('jk_pelaku') ? 'has-error':'' }}">
                                        <option value="">--pilih jeni kelamin--</option>
                                        <option value="LAKI-LAKI" {{ $kecelakaan->jk_pelaku == 'LAKI-LAKI' ? 'selected':'' }}>LAKI-LAKI</option>
                                        <option value="PEREMPUAN" {{ $kecelakaan->jk_pelaku == 'PEREMPUAN' ? 'selected':'' }}>PEREMPUAN</option>
                                    </select>

                                    @if ($errors->has('jk_pelaku'))
                                        <p class="text-danger">{{ $errors->first('jk_pelaku') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="usia_pelaku" class="col-sm-3 col-form-label">Usia Pelaku</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control {{ $errors->has('usia_pelaku') ? 'has-error':'' }}" id="usia_pelaku" name="usia_pelaku" value="{{ $kecelakaan->usia_pelaku }}">

                                    @if ($errors->has('usia_pelaku'))
                                        <p class="text-danger">{{ $errors->first('usia_pelaku') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profesi_korban" class="col-sm-3 col-form-label">Profesi Pelaku</label>
                                <div class="col-sm-9">
                                    <select name="profesi_pelaku" id="profesi_pelaku" class="form-control {{ $errors->has('profesi_pelaku') ? 'has-error':'' }}">
                                        <option value="">--pilih profesi--</option>
                                        <option value="TNI/POLRI/PNS" {{ $kecelakaan->profesi_pelaku == 'TNI/POLRI/PNS' ? 'selected':'' }}>TNI/POLRI/PNS</option>
                                        <option value="SWASTA" {{ $kecelakaan->profesi_pelaku == 'SWASTA' ? 'selected':'' }}>SWASTA</option>
                                        <option value="PENGEMUDI" {{ $kecelakaan->profesi_pelaku == 'PENGEMUDI' ? 'selected':'' }}>PENGEMUDI</option>
                                        <option value="PELAJAR/MAHASISWA" {{ $kecelakaan->profesi_pelaku == 'PELAJAR/MAHASISWA' ? 'selected':'' }}>PELAJAR/MAHASISWA</option>
                                        <option value="BURUH/TANI" {{ $kecelakaan->profesi_pelaku == 'BURUH/TANI' ? 'selected':'' }}>BURUH/TANI</option>
                                        <option value="LAIN-LAIN" {{ $kecelakaan->profesi_pelaku == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
                                    </select>

                                    @if ($errors->has('profesi_pelaku'))
                                        <p class="text-danger">{{ $errors->first('profesi_pelaku') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pendidikan_korban" class="col-sm-3 col-form-label">Pendidikan Pelaku</label>
                                <div class="col-sm-9">
                                    <select name="pendidikan_pelaku" id="pendidikan_pelaku" class="form-control {{ $errors->has('pendidikan_pelaku') ? 'has-error':'' }}">
                                        <option value="">--pilih pendidikan--</option>
                                        <option value="PT" {{ $kecelakaan->pendidikan_pelaku == 'PT' ? 'selected':'' }}>PT</option>
                                        <option value="SLTA" {{ $kecelakaan->pendidikan_pelaku == 'SLTA' ? 'selected':'' }}>SLTA</option>
                                        <option value="SLTP" {{ $kecelakaan->pendidikan_pelaku == 'SLTP' ? 'selected':'' }}>SLTP</option>
                                        <option value="SD" {{ $kecelakaan->pendidikan_pelaku == 'SD' ? 'selected':'' }}>SD</option>
                                        <option value="LAIN-LAIN" {{ $kecelakaan->pendidikan_pelaku == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
                                    </select>

                                    @if ($errors->has('pendidikan_pelaku'))
                                        <p class="text-danger">{{ $errors->first('pendidikan_pelaku') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sim_pelaku" class="col-sm-3 col-form-label">SIM Pelaku</label>
                                <div class="col-sm-9">
                                    <select name="sim_pelaku" id="sim_pelaku" class="form-control {{ $errors->has('sim_pelaku') ? 'has-error':'' }}">
                                        <option value="">--pilih sim--</option>
                                        <option value="A" {{ $kecelakaan->sim_pelaku == 'A' ? 'selected':'' }}>A</option>
                                        <option value="AU" {{ $kecelakaan->sim_pelaku == 'AU' ? 'selected':'' }}>AU</option>
                                        <option value="BI" {{ $kecelakaan->sim_pelaku == 'BI' ? 'selected':'' }}>BI</option>
                                        <option value="BI U" {{ $kecelakaan->sim_pelaku == 'BI U' ? 'selected':'' }}>BI U</option>
                                        <option value="BII" {{ $kecelakaan->sim_pelaku == 'BII' ? 'selected':'' }}>BII</option>
                                        <option value="BII U" {{ $kecelakaan->sim_pelaku == 'BII U' ? 'selected':'' }}>BII U</option>
                                        <option value="C" {{ $kecelakaan->sim_pelaku == 'C' ? 'selected':'' }}>C</option>
                                        <option value="TANPA SIM" {{ $kecelakaan->sim_pelaku == 'TANPA SIM' ? 'selected':'' }}>TANPA SIM</option>
                                    </select>

                                    @if ($errors->has('sim_pelaku'))
                                        <p class="text-danger">{{ $errors->first('sim_pelaku') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-success px-4 mr-2">Simpan</button>
                                    <a href="{{ route('data-kecelakaan.index') }}" class="btn btn-light px-4 float-right">Kembali</a>
                                </div>
                            </div>

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
            $("#data-kecelakaan").addClass('active');
        });

        function hapusData(id){
          let y = confirm('Yakin mau dihapus?');
          if(y) $("#user-" + id).submit();
        }

        function searchData(){
            //
        }
    </script>
@endsection

