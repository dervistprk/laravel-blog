@extends('backend.layout.master')
@section('title', 'Makale Oluştur')
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
            <form action="{{route('admin.makaleler.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" class="text-info font-weight-bold">Makale Başlığı</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sub_title" class="text-info font-weight-bold">Makale Alt Başlığı</label>
                    <input type="text" name="sub_title" id="sub_title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="category" class="text-info font-weight-bold">Makale Kategorisi</label>
                    <select class="form-control" name="category" id="category" required>
                        <option value="">Lütfen Seçiniz...</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image" class="text-info font-weight-bold">Makale Resmi</label>
                    <input type="file" name="image" id="image" class="form-control btn btn-primary btn-sm" required>
                </div>
                <div class="form-group">
                    <label for="editor" class="text-info font-weight-bold">Makale İçeriği</label>
                    <textarea name="content" id="editor" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Oluştur</button>
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
