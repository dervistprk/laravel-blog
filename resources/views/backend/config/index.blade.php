@extends('backend.layout.master')
@section('title', 'Ayarlar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.config.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="font-weight-bold text-info">Site Başlığı(*)</label>
                            <input id="title" type="text" name="title" value="{{$config->title}}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="active" class="font-weight-bold text-info">Site Aktiflik Durumu(*)</label>
                            <select class="form-control" name="active" id="active" required>
                                <option @if($config->active == 1) selected=selected @endif value="1">Açık</option>
                                <option @if($config->active == 0) selected=selected @endif value="0">Kapalı</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logo" class="font-weight-bold text-info">Site Logosu</label>
                            <input id="logo" type="file" name="logo" class="form-control btn btn-primary btn-sm">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="favicon" class="font-weight-bold text-info">Site Favicon</label>
                            <input id="favicon" type="file" name="favicon" class="form-control btn btn-primary btn-sm">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook" class="font-weight-bold text-info">Facebook</label>
                            <input id="facebook" type="text" name="facebook" value="{{$config->facebook}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="twitter" class="font-weight-bold text-info">Twitter</label>
                            <input id="twitter" type="text" name="twitter" value="{{$config->twitter}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="github" class="font-weight-bold text-info">Github</label>
                            <input id="github" type="text" name="github" value="{{$config->github}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="linkedin" class="font-weight-bold text-info">Linkedin</label>
                            <input id="linkedin" type="text" name="linkedin" value="{{$config->linkedin}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="youtube" class="font-weight-bold text-info">Youtube</label>
                            <input id="youtube" type="text" name="youtube" value="{{$config->youtube}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instagram" class="font-weight-bold text-info">Instagram</label>
                            <input id="instagram" type="text" name="instagram" value="{{$config->instagram}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-md btn-success">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection
