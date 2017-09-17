@extends('frontend.body')
@section('title')
<title>{{$page->$title_user}}</title>
@stop
@section('content')
    <section id="page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 id="page-title">{{$page->$title_user}}</h1>
                    <div class="line-title"></div>
                </div>
            </div>
        </div>
        <div class="container">
                {!! $page->$description_user !!}
        </div>
    </section>
@stop