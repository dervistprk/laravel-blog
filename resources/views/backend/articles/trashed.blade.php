@extends('backend.layout.master')
@section('title', 'Silinen Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                <span class="text-info float-right"><b>{{$articles->count()}}</b> Makale Bulundu.</span>
                <a href="{{route('admin.makaleler.index')}}" class="btn btn-primary btn-sm float-right" style="margin-right: 10px;"><i class="fa fa-thumbs-up"> Aktif Makaleler</i></a>
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
                                <a href="{{route('admin.recover.article', $article->id)}}" class="btn btn-sm btn-primary" title="Kurtar"><i class="fa fa-recycle"></i></a>
                                <a href="{{route('admin.hard.delete.article', $article->id)}}" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
