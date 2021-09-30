@extends('backend.layout.master')
@section('title',$page->title.' Sayfasını Düzenle')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form action="{{route('admin.pages.edit.post', $page->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" class="text-info font-weight-bold">Sayfa Başlığı</label>
                    <input type="text" name="title" id="title" class="form-control" required value="{{$page->title}}">
                </div>
                <div class="form-group">
                    <label for="image" class="text-info font-weight-bold">Sayfa Resmi</label><br>
                    <img src="{{URL::asset($page->image)}}" alt="makale-resmi" width="300" class="img-thumbnail rounded">
                    <input type="file" name="image" id="image" class="form-control btn btn-primary btn-sm" style="margin-top: 10px;">
                </div>
                <div class="form-group">
                    <label for="editor" class="text-info font-weight-bold">Sayfa İçeriği</label>
                    <textarea name="content" id="editor" class="form-control" rows="5">{!! $page->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('custom-css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('custom-js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#editor').summernote({
                    'height': 300,
                }
            );
        });
    </script>
@endsection
