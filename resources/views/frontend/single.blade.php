@extends('frontend.layouts.master')
@section('title', $article->title)
@section('bg') {{$article->image}} @endsection
@section('content')
                <div class="col-md-9 mx-auto">
                    {!! $article->content !!}
                    <span class="text-info float-end" style="margin-top: 25px;">Okunma Sayısı : <b>{{$article->hit}}</b></span>
                </div>
    @include('frontend.widgets.categoryWidget')
@endsection
