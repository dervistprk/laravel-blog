@extends('frontend.layouts.master')
@section('title', 'Anasayfa')
@section('content')
    @include('frontend.widgets.most-viewed')
    <div class="col-md-8 mx-auto">
        @include('frontend.widgets.articleList')
    </div>
    @include('frontend.widgets.categoryWidget')
@endsection
