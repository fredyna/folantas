@extends('templates.front.master')

@section('content')
   <!-- HERO
    ================================================== -->
    <section class="page-banner-area page-about">
        <div class="overlay"></div>
        <!-- Content -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-12 col-12 text-center">
                    <div class="page-banner-content">
                        <h1 class="display-4 font-weight-bold">Berita</h1>
                        <p>Kumpulan berita kami seputar informasi lalu lintas</p>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

 <section class="section" id="blog">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 text-center">
                    <div class="section-heading">
                        <!-- Heading -->
                        <h2 class="section-title">
                            {{ $berita->judul }}
                        </h2>

                        <!-- Subheading -->
                        <p>
                            {{ date('d M Y', strtotime($berita->created_at)) }}
                        </p>
                    </div>
                </div>
            </div> <!-- / .row -->

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    {!! $berita->deskripsi !!}
                </div>
            </div>
        </div>
    </section>
@endsection
