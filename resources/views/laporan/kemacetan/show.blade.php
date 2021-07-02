@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Lapor Kemacetan</li>
            </ol>
        </nav>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Form Lapor Kemacetan</h6>
                        <hr />

                        <form action="{{ route('lapor-kemacetan.update', $laporan->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="judul" class="col-sm-3 col-form-label">Judul Laporan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has('judul') ? 'has-error':'' }}" id="judul" name="judul"  value="{{ $laporan->judul }}" placeholder="masukan judul laporan ..." required>

                                    @if ($errors->has('judul'))
                                        <p class="text-danger">{{ $errors->first('judul') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lokasi" class="col-sm-3 col-form-label">Lokasi Macet</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has('lokasi') ? 'has-error':'' }}" id="lokasi" name="lokasi" value="{{ $laporan->lokasi }}" placeholder="masukan lokasi ..." required>

                                    @if ($errors->has('lokasi'))
                                        <p class="text-danger">{{ $errors->first('lokasi') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="panjang" class="col-sm-3 col-form-label">Panjang Macet (KM)</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control {{ $errors->has('panjang') ? 'has-error':'' }}" id="panjang" name="panjang" value="{{ $laporan->panjang }}" placeholder="masukan panjang (KM) ..." required>

                                    @if ($errors->has('panjang'))
                                        <p class="text-danger">{{ $errors->first('panjang') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="penyebab" class="col-sm-3 col-form-label">Sebab Macet</label>
                                <div class="col-sm-9">
                                    <select name="penyebab" id="penyebab" class="form-control {{ $errors->has('penyebab') ? 'has-error':'' }}" required>
                                        <option value="" style="display: none">--pilih sebab macet --</option>
                                        <option value="KECELAKAAN" {{ $laporan->penyebab == 'KECELAKAAN' ? 'selected':'' }}>KECELAKAAN</option>
                                        <option value="PENUTUPAN JALAN" {{ $laporan->penyebab == 'PENUTUPAN JALAN' ? 'selected':'' }}>PENUTUPAN JALAN</option>
                                        <option value="KERETA API" {{ $laporan->penyebab == 'KERETA API' ? 'selected':'' }}>KERETA API</option>
                                        <option value="LAINNYA" {{ $laporan->penyebab == 'LAINNYA' ? 'selected':'' }}>LAINNYA</option>
                                    </select>

                                    @if ($errors->has('penyebab'))
                                        <p class="text-danger">{{ $errors->first('penyebab') }}</p>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                                <div class="col-sm-9">
                                    <img src="{{ asset('berkas/laporan/' . $laporan->foto) }}" alt="Foto" style="width: 200px;" >
                                </div>
                                <div class="col-sm-9 offset-sm-3 mt-4">
                                    <input type="file" class="form-control {{ $errors->has('foto') ? 'has-error':'' }}" id="foto" name="foto" placeholder="pilih foto">

                                    @if ($errors->has('foto'))
                                        <p class="text-danger">{{ $errors->first('foto') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea id="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'has-error':'' }}" id="deskripsi" name="deskripsi" placeholder="masukan deskripsi berita ..." required>{{ $laporan->deskripsi }}</textarea>

                                    @if ($errors->has('deskripsi'))
                                        <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-success px-3 ">Simpan</button>
                                    <a href="{{ route('data-kecelakaan.create-berita') . '?laporan_id=' . $laporan->id }}" class="btn btn-light px-3 ml-1 float-right"><i class="fa fa-pencil"></i> Buat Berita</a>
                                    @if($laporan->status == 'PENDING')
                                    <a href="{{ route('lapor-kemacetan.change-status') . '?laporan_id=' . $laporan->id . '&status=DITOLAK' }}" class="btn btn-danger px-3 ml-1 float-right"><i class="fa fa-close"></i> Tolak</a>
                                    <a href="{{ route('lapor-kemacetan.change-status') . '?laporan_id=' . $laporan->id . '&status=DISETUJUI' }}" class="btn btn-primary px-3 ml-1 float-right"><i class="fa fa-check"></i> Setujui</a>
                                    @endif
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

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/node_modules/summernote/dist/summernote-bs4.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/node_modules/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script>
        $(function(){
            $("#data-laporan").addClass("active");
            $("#data-laporan .collapse").addClass("show");
            $("#lapor-kemacetan").addClass("active");
        });

        /*Summernote editor*/
        if ($("#deskripsi").length) {
            $('#deskripsi').summernote({
                height: 300,
                tabsize: 2
            });
        }
    </script>
@endsection

