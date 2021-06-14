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
                            Berita Terbaru Kami
                        </h2>

                        <!-- Subheading -->
                        <p>
                            Dapatkan berita terbaru kami seputar informasi lalu lintas
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

                {{ $berita->links() }}

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
