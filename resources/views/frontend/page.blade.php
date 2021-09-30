@extends('frontend.layouts.master')
@section('title', $page->title)
@section('bg', $page->image)
@section('content')
    <div class="col-md-10 col-lg-8 mx-auto" style="margin-bottom: 30px;">
        {!! $page->content !!}
    </div>
@endsection

