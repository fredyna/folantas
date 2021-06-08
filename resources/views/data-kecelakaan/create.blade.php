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

                        <form action="{{ route('data-kecelakaan.store') }}" method="post">
                            @csrf

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
                                <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <select name="hari" id="hari" class="form-control {{ $errors->has('hari') ? 'has-error':'' }}">
                                        <option value="">--pilih hari--</option>
                                        <option value="SENIN" {{ old('hari') == 'SENIN' ? 'selected':'' }}>SENIN</option>
                                        <option value="SELASA" {{ old('hari') == 'SELASA' ? 'selected':'' }}>SELASA</option>
                                        <option value="RABU" {{ old('hari') == 'RABU' ? 'selected':'' }}>RABU</option>
                                        <option value="KAMIS" {{ old('hari') == 'KAMIS' ? 'selected':'' }}>KAMIS</option>
                                        <option value="JUMAT" {{ old('hari') == 'JUMAT' ? 'selected':'' }}>JUMAT</option>
                                        <option value="SABTU" {{ old('hari') == 'SABTU' ? 'selected':'' }}>SABTU</option>
                                        <option value="MINGGU" {{ old('hari') == 'MINGGU' ? 'selected':'' }}>MINGGU</option>
                                    </select>

                                    @if ($errors->has('hari'))
                                        <p class="text-danger">{{ $errors->first('hari') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="waktu_laka" class="col-sm-3 col-form-label">Waktu_laka Kejadian</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control {{ $errors->has('waktu_laka') ? 'has-error':'' }}" id="waktu_laka" name="waktu_laka"  value="{{ old('waktu_laka') }}">

                                    @if ($errors->has('waktu_laka'))
                                        <p class="text-danger">{{ $errors->first('waktu_laka') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kendaraan_terlibat" class="col-sm-3 col-form-label">Kendaraan Terlibat</label>
                                <div class="col-sm-9">
                                    <select name="kendaraan_terlibat" id="kendaraan_terlibat" class="form-control {{ $errors->has('kendaraan_terlibat') ? 'has-error':'' }}">
                                        <option value="">--pilih kendaraan terlibat--</option>
                                        <option value="MOBIL PRIBADI" {{ old('kendaraan_terlibat') == 'MOBIL PRIBADI' ? 'selected':'' }}>MOBIL PRIBADI</option>
                                        <option value="MOBIL BEBAN" {{ old('kendaraan_terlibat') == 'MOBIL BEBAN' ? 'selected':'' }}>MOBIL BEBAN</option>
                                        <option value="MOBIL PENUMPANG" {{ old('kendaraan_terlibat') == 'MOBIL PENUMPANG' ? 'selected':'' }}>MOBIL PENUMPANG</option>
                                        <option value="BUS" {{ old('kendaraan_terlibat') == 'BUS' ? 'selected':'' }}>BUS</option>
                                        <option value="SEPEDA MOTOR" {{ old('kendaraan_terlibat') == 'SEPEDA MOTOR' ? 'selected':'' }}>SEPEDA MOTOR</option>
                                        <option value="RAN TIDAK BERMOTOR" {{ old('kendaraan_terlibat') == 'RAN TIDAK BERMOTOR' ? 'selected':'' }}>RAN TIDAK BERMOTOR</option>
                                        <option value="KA" {{ old('kendaraan_terlibat') == 'KA' ? 'selected':'' }}>KA</option>
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
                                        <option value="LAKI-LAKI" {{ old('jk_korban') == 'LAKI-LAKI' ? 'selected':'' }}>LAKI-LAKI</option>
                                        <option value="PEREMPUAN" {{ old('jk_korban') == 'PEREMPUAN' ? 'selected':'' }}>PEREMPUAN</option>
                                    </select>

                                    @if ($errors->has('jk_korban'))
                                        <p class="text-danger">{{ $errors->first('jk_korban') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="usia_korban" class="col-sm-3 col-form-label">Usia Korban</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control {{ $errors->has('usia_korban') ? 'has-error':'' }}" id="usia_korban" name="usia_korban" value="{{ old('usia_korban') }}">

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
                                        <option value="TNI/POLRI/PNS" {{ old('profesi_korban') == 'TNI/POLRI/PNS' ? 'selected':'' }}>TNI/POLRI/PNS</option>
                                        <option value="SWASTA" {{ old('profesi_korban') == 'SWASTA' ? 'selected':'' }}>SWASTA</option>
                                        <option value="PENGEMUDI" {{ old('profesi_korban') == 'PENGEMUDI' ? 'selected':'' }}>PENGEMUDI</option>
                                        <option value="PELAJAR/MAHASISWA" {{ old('profesi_korban') == 'PELAJAR/MAHASISWA' ? 'selected':'' }}>PELAJAR/MAHASISWA</option>
                                        <option value="BURUH/TANI" {{ old('profesi_korban') == 'BURUH/TANI' ? 'selected':'' }}>BURUH/TANI</option>
                                        <option value="LAIN-LAIN" {{ old('profesi_korban') == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
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
                                        <option value="PT" {{ old('pendidikan_korban') == 'PT' ? 'selected':'' }}>PT</option>
                                        <option value="SLTA" {{ old('pendidikan_korban') == 'SLTA' ? 'selected':'' }}>SLTA</option>
                                        <option value="SLTP" {{ old('pendidikan_korban') == 'SLTP' ? 'selected':'' }}>SLTP</option>
                                        <option value="SD" {{ old('pendidikan_korban') == 'SD' ? 'selected':'' }}>SD</option>
                                        <option value="LAIN-LAIN" {{ old('pendidikan_korban') == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
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
                                        <option value="A" {{ old('sim_korban') == 'A' ? 'selected':'' }}>A</option>
                                        <option value="AU" {{ old('sim_korban') == 'AU' ? 'selected':'' }}>AU</option>
                                        <option value="BI" {{ old('sim_korban') == 'BI' ? 'selected':'' }}>BI</option>
                                        <option value="BI U" {{ old('sim_korban') == 'BI U' ? 'selected':'' }}>BI U</option>
                                        <option value="BII" {{ old('sim_korban') == 'BII' ? 'selected':'' }}>BII</option>
                                        <option value="BII U" {{ old('sim_korban') == 'BII U' ? 'selected':'' }}>BII U</option>
                                        <option value="C" {{ old('sim_korban') == 'C' ? 'selected':'' }}>C</option>
                                        <option value="TANPA SIM" {{ old('sim_korban') == 'TANPA SIM' ? 'selected':'' }}>TANPA SIM</option>
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
                                        <option value="LAKI-LAKI" {{ old('jk_pelaku') == 'LAKI-LAKI' ? 'selected':'' }}>LAKI-LAKI</option>
                                        <option value="PEREMPUAN" {{ old('jk_pelaku') == 'PEREMPUAN' ? 'selected':'' }}>PEREMPUAN</option>
                                    </select>

                                    @if ($errors->has('jk_pelaku'))
                                        <p class="text-danger">{{ $errors->first('jk_pelaku') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="usia_pelaku" class="col-sm-3 col-form-label">Usia Pelaku</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control {{ $errors->has('usia_pelaku') ? 'has-error':'' }}" id="usia_pelaku" name="usia_pelaku" value="{{ old('usia_pelaku') }}">

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
                                        <option value="TNI/POLRI/PNS" {{ old('profesi_pelaku') == 'TNI/POLRI/PNS' ? 'selected':'' }}>TNI/POLRI/PNS</option>
                                        <option value="SWASTA" {{ old('profesi_pelaku') == 'SWASTA' ? 'selected':'' }}>SWASTA</option>
                                        <option value="PENGEMUDI" {{ old('profesi_pelaku') == 'PENGEMUDI' ? 'selected':'' }}>PENGEMUDI</option>
                                        <option value="PELAJAR/MAHASISWA" {{ old('profesi_pelaku') == 'PELAJAR/MAHASISWA' ? 'selected':'' }}>PELAJAR/MAHASISWA</option>
                                        <option value="BURUH/TANI" {{ old('profesi_pelaku') == 'BURUH/TANI' ? 'selected':'' }}>BURUH/TANI</option>
                                        <option value="LAIN-LAIN" {{ old('profesi_pelaku') == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
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
                                        <option value="PT" {{ old('pendidikan_pelaku') == 'PT' ? 'selected':'' }}>PT</option>
                                        <option value="SLTA" {{ old('pendidikan_pelaku') == 'SLTA' ? 'selected':'' }}>SLTA</option>
                                        <option value="SLTP" {{ old('pendidikan_pelaku') == 'SLTP' ? 'selected':'' }}>SLTP</option>
                                        <option value="SD" {{ old('pendidikan_pelaku') == 'SD' ? 'selected':'' }}>SD</option>
                                        <option value="LAIN-LAIN" {{ old('pendidikan_pelaku') == 'LAIN-LAIN' ? 'selected':'' }}>LAIN-LAIN</option>
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
                                        <option value="A" {{ old('sim_pelaku') == 'A' ? 'selected':'' }}>A</option>
                                        <option value="AU" {{ old('sim_pelaku') == 'AU' ? 'selected':'' }}>AU</option>
                                        <option value="BI" {{ old('sim_pelaku') == 'BI' ? 'selected':'' }}>BI</option>
                                        <option value="BI U" {{ old('sim_pelaku') == 'BI U' ? 'selected':'' }}>BI U</option>
                                        <option value="BII" {{ old('sim_pelaku') == 'BII' ? 'selected':'' }}>BII</option>
                                        <option value="BII U" {{ old('sim_pelaku') == 'BII U' ? 'selected':'' }}>BII U</option>
                                        <option value="C" {{ old('sim_pelaku') == 'C' ? 'selected':'' }}>C</option>
                                        <option value="TANPA SIM" {{ old('sim_pelaku') == 'TANPA SIM' ? 'selected':'' }}>TANPA SIM</option>
                                    </select>

                                    @if ($errors->has('sim_pelaku'))
                                        <p class="text-danger">{{ $errors->first('sim_pelaku') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-success px-4 mr-2">Tambah</button>
                                    <button type="reset" class="btn btn-light px-4 float-right">Reset</button>
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

