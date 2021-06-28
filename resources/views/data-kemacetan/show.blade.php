@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Data Kemacetan</li>
            </ol>
        </nav>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Form Data Kemacetan</h6>
                        <hr />

                        <form action="{{ route('data-kemacetan.update', $kemacetan->id) }}" method="post">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                @php
                                    $tanggal = date('Y-m-d', strtotime($kemacetan->waktu));
                                    $jam = date('H', strtotime($kemacetan->waktu));
                                    $menit = date('i', strtotime($kemacetan->waktu));
                                    $detik = date('s', strtotime($kemacetan->waktu));
                                @endphp
                                <label for="waktu" class="col-sm-3 col-form-label">Waktu Kemacetan</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control {{ $errors->has('waktu') ? 'has-error':'' }}" id="waktu" name="waktu"  value="{{ $tanggal }}">
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
                                    @if ($errors->has('waktu'))
                                        <p class="text-danger">{{ $errors->first('waktu') }}</p>
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
                                <label for="lokasi" class="col-sm-3 col-form-label">Lokasi Macet</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has('lokasi') ? 'has-error':'' }}" id="lokasi" name="lokasi" value="{{ $kemacetan->lokasi }}" placeholder="masukan lokasi ...">

                                    @if ($errors->has('lokasi'))
                                        <p class="text-danger">{{ $errors->first('lokasi') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="panjang" class="col-sm-3 col-form-label">Panjang Macet (KM)</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control {{ $errors->has('panjang') ? 'has-error':'' }}" id="panjang" name="panjang" value="{{ $kemacetan->panjang }}" placeholder="masukan panjang (KM) ...">

                                    @if ($errors->has('panjang'))
                                        <p class="text-danger">{{ $errors->first('panjang') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="penyebab" class="col-sm-3 col-form-label">Sebab Macet</label>
                                <div class="col-sm-9">
                                    <select name="penyebab" id="penyebab" class="form-control {{ $errors->has('penyebab') ? 'has-error':'' }}">
                                        <option value="" style="display: none">--pilih sebab macet --</option>
                                        <option value="KECELAKAAN" {{ $kemacetan->penyebab == 'KECELAKAAN' ? 'selected':'' }}>KECELAKAAN</option>
                                        <option value="PENUTUPAN JALAN" {{ $kemacetan->penyebab == 'PENUTUPAN JALAN' ? 'selected':'' }}>PENUTUPAN JALAN</option>
                                        <option value="KERETA API" {{ $kemacetan->penyebab == 'KERETA API' ? 'selected':'' }}>KERETA API</option>
                                        <option value="LAINNYA" {{ $kemacetan->penyebab == 'LAINNYA' ? 'selected':'' }}>LAINNYA</option>
                                    </select>

                                    @if ($errors->has('penyebab'))
                                        <p class="text-danger">{{ $errors->first('penyebab') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-success px-4 mr-2">Simpan</button>
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
            $("#data-kemacetan").addClass('active');
        });
    </script>
@endsection

