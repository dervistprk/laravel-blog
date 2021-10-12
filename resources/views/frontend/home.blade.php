@extends('frontend.layouts.master')
@section('title', 'Anasayfa')
@section('content')
    <div class="col-md-8 mx-auto">
        @include('frontend.widgets.articleList')
    </div>
    @include('frontend.widgets.categoryWidget')
    @include('frontend.widgets.most-viewed')
@endsection
