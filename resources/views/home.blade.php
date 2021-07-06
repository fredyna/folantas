@extends('templates.front.master')

@section('content')
    @include('templates.front.partials._navbar')
<!-- HERO
================================================== -->
<section class="banner-area py-7">
    <!-- Content -->
    <div class="container">
        <div class="row  align-items-center">
            <div class="col-md-12 col-lg-7 text-center text-lg-left">
                <div class="main-banner">
                    <!-- Heading -->
                    <h1 class="display-4 mb-4 font-weight-normal">
                        Info Lalu Lintas
                    </h1>

                    <!-- Subheading -->
                    <p class="lead mb-4">
                        Folantas adalah website penyedia informasi terkini terkait situasi lalu lintas di Kabupaten Tegal dan sekitarnya.
                    </p>

                    <!-- Button -->
                    <p class="mb-0">
                        <a href="#berita" class="btn btn-primary btn-circled">
                            Berita Terbaru
                        </a>
                    </p>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block">
                <div class="banner-img-block">
                    <img src="{{ asset('rappo/images/bg/a.png') }}" alt="bg hero" class="img-fluid">
                </div>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>

<section class="section bg-grey" id="feature">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="text-center feature-block">
                    <div class="img-icon-block mb-4">
                        <i class="ti-thumb-up"></i>
                    </div>
                    <h4 class="mb-2">Data Valid</h4>
                    <p>Data yang disajikan sudah divalidasi kebenaran faktanya.</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="text-center feature-block">
                    <div class="img-icon-block mb-4">
                        <i class="ti-layout-media-right"></i>
                    </div>
                    <h4 class="mb-2">Berita Up To Date</h4>
                    <p>Kami menyajikan berita hangat tentang lalu lintas.</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="text-center feature-block">
                    <div class="img-icon-block mb-4">
                        <i class="ti-dashboard"></i>
                    </div>
                    <h4 class="mb-2">Respon Cepat</h4>
                    <p>Segera memproses laporan kecelakaan yang masuk pada sistem.</p>
                </div>
            </div>
        </div>
    </div> <!-- / .container -->
</section>

<section class="section" id="berita">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <div class="section-heading">
                    <!-- Heading -->
                    <h2 class="section-title">
                        Berita Terbaru
                    </h2>

                    <!-- Subheading -->
                    <p>
                        Berita terbaru kami seputar informasi lalu lintas
                    </p>
                </div>
            </div>
        </div> <!-- / .row -->

        @if (count($berita) > 0)
        <div class="row justify-content-center">
            @foreach ($berita as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-box">
                        <div class="blog-img-box">
                            <img src="{{ asset('berkas/berita/' . $item->thumbnail) }}" alt="" class="img-fluid blog-img">
                        </div>
                        <div class="single-blog">
                            <div class="blog-content">
                                <h6> {{ date('d M Y', strtotime($item->created_at)) }}</h6>
                                <a href="{{ route('themes.berita.show', $item->slug) }}">
                                    <h3 class="card-title">{{ Str::limit($item->judul, 50, '...') }}</h3>
                                </a>
                                <p>{!! Str::limit(strip_tags($item->deskripsi), 160, '...') !!}</p>
                                {{-- <p>{!! $item->deskripsi !!}</p> --}}
                                <a href="{{ route('themes.berita.show', $item->slug) }}" class="read-more">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('themes.berita') }}" class="btn btn-primary btn-circled">
                    Semua Berita
                </a>
            </div>
        </div>

        @else
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <i>Tidak ada data</i>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
