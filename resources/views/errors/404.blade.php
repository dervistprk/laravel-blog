@section('title', 'Sayfa Bulunamadı')
@extends('frontend.layouts.master')
@section('content')
    <div class="alert alert-danger text-center" style="margin-bottom: 50px;">
        <img src="{{URL::asset('page_images/http-error-404.jpg')}}" alt="404-image" width="350" height="250" style="border-radius: 10px;">
        <p>
            <h6>Aradığınız sayfa bulunamıyor. Lütfen adresi kontrol edip tekrar deneyiniz.</h6>
        </p>
    </div>
@endsection
