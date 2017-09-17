@extends('frontend.body')
@section('title')
	<title>{{$page->$title_user}}</title>
	<meta content="{{$page->$meta_description_user}}" name="description">
@stop
@section('content')
	<section id="contact">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1 id="page-title">{{$page->$title_user}}</h1>
						<div class="line-title"></div>
					</div>
				</div>
			</div>

			<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="text">
							{!! $page->$description_user !!}</div>
						</div>
					</div>

					<div class="row">

						<div class="col-md-8 col-xs-12" id="address-wrapper">
							<div id="address">

								{!! $contact->map !!}

							</div>
						</div>

					@include('contactforms')

					</div>
			</div>
	</section>
@stop