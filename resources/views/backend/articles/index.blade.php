@extends('backend.layout.master')
@section('title', 'Tüm Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                <span class="text-info float-right"><b>{{$articles->count()}}</b> Makale Bulundu.</span>
                <a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm float-right" style="margin-right: 10px;"><i class="fa fa-trash"> Silinen Makaleler</i></a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Makale Resmi</th>
                        <th style="width: 300px;">Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th style="width: 150px;">Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td><img src="{{URL::asset($article->image)}}" width="200" alt="makale-resim"></td>
                            <td style="width: 300px;">{{$article->title}}</td>
                            <td>{{$article->category->name}}</td>
                            <td>{{$article->hit}}</td>
                            <td style="width: 150px;">{{$article->created_at->diffForHumans()}}</td>
                            <td>
                                <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-onstyle="success" data-off="Pasif" data-offstyle="danger" @if($article->status == 1) checked @endif data-toggle="toggle">
                            </td>
                            <td>
                                <a target="_blank" href="{{route('single', [$article->category->slug, $article->slug])}}" class="btn btn-sm btn-success" title="Görüntüle"><i class="fa fa-eye"></i></a>
                                <a href="{{route('admin.makaleler.edit', $article->id)}}" class="btn btn-sm btn-primary" title="Düzenle"><i class="fa fa-pen"></i></a>
                                <a href="{{route('admin.delete.article', $article->id)}}" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></a>
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $('.switch').change(function () {
                var id = $(this)[0].getAttribute('article-id');
                var statu = $(this).prop('checked');
                $.get("{{route('admin.switch')}}", {id: id, statu: statu}, function (data, status) {
                });
            })
        })
    </script>
@endsection
