@extends('frontend.body')
@section('title')
	<title>{{$page->$title_user}}</title>
	<meta name="description" content="{{$page->$meta_description_user}}">
@stop
@section('content')
	<section id="about">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1 id="page-title">{{$page->$title_user}}</h1>
						<div class="line-title"></div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="page-content">
				{!! $page->$description_user !!}
				</div>
			</div>
	</section>
@stop