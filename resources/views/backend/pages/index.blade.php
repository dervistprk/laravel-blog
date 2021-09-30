@extends('backend.layout.master')
@section('title', 'Tüm Sayfalar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                <span class="text-info float-right"><b>{{$pages->count()}}</b> Sayfa Bulundu.</span>
            </h6>
        </div>
        <div id="orderSuccess" style="display: none; margin: 15px 15px 0 15px;" class="alert alert-success">
            Sayfa sıralaması başarıyla güncellendi.
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 75px;">Sıralama</th>
                        <th>Sayfa Resmi</th>
                        <th>Makale Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody id="orders">
                    @foreach($pages as $page)
                        <tr id="page_{{$page->id}}">
                            <td style="width: 75px; vertical-align: middle; text-align: center;"><i class="fa fa-sort fa-2x handle" style="cursor: move;"></i></td>
                            <td><img src="{{URL::asset($page->image)}}" width="200" alt="sayfa-resim"></td>
                            <td>{{$page->title}}</td>
                            <td>
                                <input class="switch" page-id="{{$page->id}}" type="checkbox" data-on="Aktif" data-onstyle="success" data-off="Pasif" data-offstyle="danger" @if($page->status == 1) checked @endif data-toggle="toggle">
                            </td>
                            <td>
                                <a target="_blank" href="{{route('pages', $page->slug)}}" class="btn btn-sm btn-success" title="Görüntüle"><i class="fa fa-eye"></i></a>
                                <a href="{{route('admin.pages.edit', $page->id)}}" class="btn btn-sm btn-primary" title="Düzenle"><i class="fa fa-pen"></i></a>
                                <a href="{{route('admin.pages.delete', $page->id)}}" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('custom-css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('custom-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    <script>
       $('#orders').sortable({
            handle: '.handle',
            update: function (){
               var siralama = $('#orders').sortable('serialize');
               $.get("{{route('admin.pages.orders')}}?" + siralama, function (data,status){
                   $('#orderSuccess').show().delay(3000).fadeOut();
               });
            }
       });
    </script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $('.switch').change(function () {
                var id = $(this)[0].getAttribute('page-id');
                var statu = $(this).prop('checked');
                $.get("{{route('admin.page.switch')}}", {id: id, statu: statu}, function (data, status) {});
            })
        })
    </script>
@endsection
