@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Lapor Kecelakaan</li>
            </ol>
        </nav>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Form Lapor Kecelakaan</h6>
                        <hr />

                        <form action="{{ route('lapor-kecelakaan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="judul" class="col-sm-3 col-form-label">Judul Laporan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has('judul') ? 'has-error':'' }}" id="judul" name="judul"  value="{{ old('judul') }}" placeholder="masukan judul laporan ..." required>

                                    @if ($errors->has('judul'))
                                        <p class="text-danger">{{ $errors->first('judul') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has('lokasi') ? 'has-error':'' }}" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="masukan lokasi ..." required>

                                    @if ($errors->has('lokasi'))
                                        <p class="text-danger">{{ $errors->first('lokasi') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control {{ $errors->has('foto') ? 'has-error':'' }}" id="foto" name="foto" placeholder="pilih foto" required>

                                    @if ($errors->has('foto'))
                                        <p class="text-danger">{{ $errors->first('foto') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea id="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'has-error':'' }}" id="deskripsi" name="deskripsi" placeholder="masukan deskripsi berita ..." required>{{ old('deskripsi') }}</textarea>

                                    @if ($errors->has('deskripsi'))
                                        <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
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

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/node_modules/summernote/dist/summernote-bs4.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/node_modules/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script>
        $(function(){
            $("#data-laporan").addClass("active");
            $("#data-laporan .collapse").addClass("show");
            $("#lapor-kecelakaan").addClass("active");
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

