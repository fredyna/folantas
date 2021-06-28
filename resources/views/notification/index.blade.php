@extends('templates.master')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item">Notifikasi</li>
            </ol>
        </nav>

        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Notifikasi</h5>
                        <hr />

                        @if ($notifications && $notifications->count() > 0)
                            @foreach ($notifications as $notif)
                                <div class="preview-list">

                                <div class="preview-item border-bottom px-3 {{ $notif->read_at == null ? 'alert-warning' : '' }}" onclick="openNotification('{{ $notif->id }}', '{{ $notif->data['url'] }}')">
                                        <div class="preview-item-content d-flex flex-grow">
                                            <div class="flex-grow">
                                                <h6 class="preview-subject">{{ $notif->data['judul'] }}
                                                    <span class="float-right small">
                                                    <span class="text-muted pr-3">{{ $notif->created_at->diffForHumans() }}</span>
                                                    </span>
                                                </h6>
                                                <p>{!! Str::limit(strip_tags($notif->data['deskripsi']), 150, '...') !!}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @else
                        <p class="text-center"><i>Tidak ada notifikasi</i></p>
                        @endif

                    </div>
                    <div class="card-footer">
                        {{ $notifications->links() }}
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
            $("#notifikasi").addClass('active');
        });

        function openNotification(id, url){
            const base_url = "{{ route('notifikasi.redirect') }}" + "?id=" + id + "&url=" + url;
            window.open(base_url, '_self');
        }
    </script>
@endsection

