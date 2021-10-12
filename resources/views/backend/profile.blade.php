@extends('backend.layout.master')
@section('title', 'Admin Profili')
@section('content')
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
        <form method="post" action="{{route('admin.profile.post')}}">
            @csrf
            <div class="form-group">
                <label for="name" class="text-info font-weight-bold">Ad Soyad (*)</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$admin->name}}" required>
            </div>
            <div class="form-group">
                <label for="email" class="text-info font-weight-bold">E-Posta (*)</label>
                <input type="text" name="email" id="email" class="form-control" value="{{$admin->email}}" required>
            </div>
            <div class="form-group">
                <label for="password" class="text-info font-weight-bold">Şifre (*)</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-block btn-success">Kaydet</button>
            </div>
        </form>
@endsection
