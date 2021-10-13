@extends('frontend.layouts.master')
@section('title', $category->name.' Kategorisi')
@section('bg', asset($category->image))
@section('content')
    <div class="col-md-9 mx-auto" style="background: ghostwhite;">
        @include('frontend.widgets.articleList')
    </div>
    @include('frontend.widgets.categoryWidget')
@endsection
