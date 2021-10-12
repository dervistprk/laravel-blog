@extends('backend.layout.master')
@section('title', 'Tüm Kategoriler')
@section('content')
    <div class="row">
        <div class="col-md-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.category.create')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="category-create" class="text-info font-weight-bold">Kategori Adı</label>
                            <input type="text" class="form-control" name="category" id="category-create" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="text-info font-weight-bold">Kategori Resmi</label>
                            <input type="file" class="btn btn-primary btn-sm" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <span class="text-success">Aktif : {{$category->articleCount()}}</span> <br>
                                        <span class="text-danger">Pasif : {{$category->articleCountPassive()}}</span>
                                        <br>
                                        <span class="text-info">Toplam : {{$category->totalArticleCount()}}</span></td>
                                    <td>
                                        <input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="Aktif" data-onstyle="success" data-off="Pasif" data-offstyle="danger" @if($category->status == 1) checked @endif data-toggle="toggle">
                                    </td>
                                    <td>
                                        <a category-id="{{$category->id}}" class="btn btn-sm btn-primary edit-click" title="Kategoriyi Düzenle"><i class="fa fa-edit"></i></a>
                                        <a category-name="{{$category->name}}" category-id="{{$category->id}}" category-count="{{$category->articleCount()}}" class="btn btn-sm btn-danger remove-click" title="Kategoriyi Sil"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Düzenle</h4>
                </div>
                <form method="post" action="{{route('admin.category.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category" class="text-info font-weight-bold">Kategori Adı</label>
                            <input type="text" class="form-control" name="category" id="category">
                            <input type="hidden" name="id" id="category_id">
                        </div>
                        <div class="form-group">
                            <label for="slug" class="text-info font-weight-bold">Kategori Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="image-update" class="text-info font-weight-bold">Kategori Resmi</label>
                            <input type="file" class="btn btn-primary btn-block btn-sm" name="image" id="image-update">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Sil</h4>
                </div>
                <div class="modal-body">
                    <div id="articleAlert" class="alert alert-danger">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kapat</button>
                    <form method="post" action="{{route('admin.category.delete')}}">
                        @csrf
                        <input type="hidden" name="deleteId" id="deleteId">
                        <button id="deleteButton" type="submit" class="btn btn-danger">Sil</button>
                    </form>
                </div>
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
            $('.edit-click').click(function () {
                const id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type: 'GET',
                    url: '{{route('admin.category.getdata')}}',
                    data: {id: id},
                    success: function (data) {
                        $('#category').val(data.name);
                        $('#slug').val(data.slug);
                        $('#category_id').val(data.id);
                        $('#editModal').modal();
                    }
                });
            });

            $('.remove-click').click(function () {
                const id = $(this)[0].getAttribute('category-id');
                const count = $(this)[0].getAttribute('category-count');
                const name = $(this)[0].getAttribute('category-name');
                if (id == 1) {
                    $('#articleAlert').html('Genel kategorisi sabit kategoridir, <b>silinemez.</b> Eğer silinen diğer kategorilere ait makale veya makaleler varsa bu kategoriye eklenecektir.');
                    $('#deleteButton').hide();
                    $('#deleteModal').modal();
                    return;
                }

                $('#deleteButton').show();
                $('#deleteId').val(id);
                $('#articleAlert').html('<b>' + name + '</b> kategorisini silmek istediğinizden emin misiniz?');
                if (count > 0) {
                    $('#articleAlert').html('<b>' + name + '</b> kategorisine ait <b>' + count + '</b> adet makale bulunmaktadır. Silmek istediğinizden emin misiniz?')
                }
                $('#deleteModal').modal();
            });

            $('.switch').change(function () {
                var id = $(this)[0].getAttribute('category-id');
                var statu = $(this).prop('checked');
                $.get("{{route('admin.category.switch')}}", {id: id, statu: statu}, function (data, status) {
                });
            })
        })
    </script>
@endsection

