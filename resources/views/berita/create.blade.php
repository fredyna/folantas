@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item active" aria-current="page">Manajemen Berita</li>
            </ol>
        </nav>

        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Form Berita</h6>
                        <hr />

                        <form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="judul" class="col-sm-3 col-form-label">Judul Berita</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has('judul') ? 'has-error':'' }}" id="judul" name="judul"  value="{{ old('judul') }}" placeholder="masukan judul berita ..." required>

                                    @if ($errors->has('judul'))
                                        <p class="text-danger">{{ $errors->first('judul') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="thumbnail" class="col-sm-3 col-form-label">Thumbnail</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control {{ $errors->has('thumbnail') ? 'has-error':'' }}" id="thumbnail" name="thumbnail" placeholder="pilih thumbnail berita" required>

                                    @if ($errors->has('thumbnail'))
                                        <p class="text-danger">{{ $errors->first('thumbnail') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi Berita</label>
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
            $("#berita").addClass('active');
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

