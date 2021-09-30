@extends('frontend.layouts.master')
@section('title', 'İletişim')
@section('bg', 'https://www.okida.com/en/wp-content/uploads/2018/04/cu.jpg')
@section('content')
    <div class="col-md-8">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>Sormak istediğiniz bir soru mu var? Ya da faydalı olabileceğini düşündüğünüz bir öneri? İstediğiniz an bizimle iletişime geçebilirsiniz.</p>
        <div class="my-5">
            <form method="post" action="{{route('contactPost')}}">
                @csrf
                <div class="form-floating">
                    <input class="form-control" id="name" name="name" value="{{old('name')}}" type="text" placeholder="Adınızı ve Soyadınızı Giriniz..." required/>
                    <label for="name">Ad Soyad</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" id="email" name="email" value="{{old('email')}}" type="text" placeholder="E-Posta Adresinizi Giriniz..." required/>
                    <label for="email">Email Adresi</label>
                </div>
                <div class="form-floating" style="margin-top: 5px;">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="topic">Konu</label>
                        <select class="form-control" name="topic" id="topic" required>
                            <option value="">Lütfen Seçiniz...</option>
                            <option @if(old('topic') == 'Bilgi') selected="selected" @endif>Bilgi</option>
                            <option @if(old('topic') == 'Destek') selected="selected" @endif>Destek</option>
                            <option @if(old('topic') == 'Genel') selected="selected" @endif>Genel</option>
                        </select>
                    </div>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required">{{old('message')}}</textarea>
                    <label for="message">Mesaj</label>
                </div>
                <div class="form-group" style="margin-top: 20px;">
                    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Gönder</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-default">
            <div class="card-header">İletişim Bilgilerimiz</div>
            <div class="card-body">Adres : Türkiye</div>
            <div class="card-body">Telefon : +90 XXX XXX XXXX</div>
            <div class="card-body">E-Posta : ornek@gmail.com</div>
            <div class="card-body">Fax : XXXX XXX XXXX</div>
        </div>
    </div>
@endsection




