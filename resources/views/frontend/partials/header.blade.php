<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('title')
<!-- Latest compiled and minified CSS -->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="{{asset('bootstrap/dist/css/bootstrap.css')}}">
<!-- Customized file -->
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<!-- Optional theme -->
<link rel="stylesheet" href="{{asset('bootstrap/dist/css/bootstrap-theme.css')}}">
	@yield('style')
	{!! Html::style('frontend/css/reset.css')!!}
	{!! Html::style('frontend/css/style.css')!!}
	{!! Html::style('frontend/css/media.css')!!}
	{!! Html::style('slick/slick.css')!!}
	{!! Html::style('slick/slick-theme.css')!!}
	{!! Html::style('css/media.css')!!}

	{!! Html::style( 'bootstrap/dist/css/bootstrap-theme.css' )!!}
</head>
<body>
<div class="p-alert success">
	<div class="p-alert-header">
		text header
	</div>
	<div class="p-alert-content">
		has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty
	</div>
</div>
<header>
	<div class="hline">
		<div class="container">
			<div class="email relative pull-left">
				<a href="mailto:{{$contact->email}}">{{$contact->email}}</a>
			</div>
			<div class="phone relative pull-left" >
				 <a href="tel:{{$contact->phone}}">{{$contact->phone}}</a>
			</div>
			{{--
			<div class="lang inline-block pull-right">
				<ul>
					<li class="relative"> Romanian {!! Html::image('frontend/images/icons/arrow-down.gif') !!}
						<ul>
							<li>
								<a href="">Russian</a>
							</li>
							<li>
								<a href="">English</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			--}}

			<div class="dropdown pull-right">
				<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					{{	Lang::getLocale()	}}
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" style="width:50px" aria-labelledby="dropdownMenu1">
					<li><a href="/">en</a></li>
					<li><a href="/ro">ro</a></li>
					<li><a href="/ru">ru</a></li>

				</ul>
			</div>




			<div class="socials inline-block pull-right">
					@if(!empty($contact->fb))<a class="facebook"  href="{{URL::to($contact->fb)}}" target="_blank" >{!! Html::image('frontend/images/icons/facebook.png')!!}</a>@endif
					@if(!empty($contact->twitter))<a class="facebook" href="{{URL::to($contact->twitter)}}" target="_blank" >{!! Html::image('frontend/images/icons/twitter.png')!!}</a>@endif
					@if(!empty($contact->google))<a class="facebook" href="{{URL::to($contact->google)}}" target="_blank" >{!! Html::image('frontend/images/icons/google.png')!!}</a>@endif
					@if(!empty($contact->ok))<a class="facebook" href="{{URL::to($contact->ok)}}" target="_blank" >{!! Html::image('frontend/images/icons/odnoklassniki.png')!!}</a>@endif
					@if(!empty($contact->wk))<a class="facebook" href="{{URL::to($contact->wk)}}" target="_blank" >{!! Html::image('frontend/images/icons/vk.png')!!}</a>@endif
			</div>
		</div>
	</div>

	<div class="mobile-logo">
			<a href="{{URL::route('/')}}">{!! Html::image('frontend/images/logo.png','', array('class' => 'logo'))!!}</a>
	</div>
	<div class="mobile-menu-toggle">
		Menu
	</div>
	<div class="mobile-menu">
		<ul>
			<li  {{ (Request::is('hotel') ? 'class=active' : '') }}><a href="{!! URL::route('hotel')!!}">{{$hotel->$title_user}}</a></li>
			<li  {{ (Request::is('conference') ? 'class=active' : '') }}><a href="{{URL::route('conference')}}">{{$conference->$title_user}}</a></li>
			@foreach(App\Category::where('status',1)->where('menu',1)->orderBy($title_user,'asc')->get() as $item)
				<li  {{ (Request::is('category/' . $item->$slug_user) ? 'class=active' : '') }}><a href="{!! URL::route('category',$item->$slug_user)!!}">{{$item->$title_user}}</a></li>			@endforeach
			<li  {{ (Request::is('about') ? 'class=active' : '') }}><a href="{!! URL::route('about')!!}">About us</a></li>
			<li  {{ (Request::is('news') ? 'class=active' : '') }}><a href="{!! URL::route('news')!!}">News</a></li>
			<li  {{ (Request::is('contacts') ? 'class=active' : '') }}><a href="{!! URL::route('contacts')!!}">Contacts</a></li>
		</ul>
	</div>


	 <div class="navigation border-bottom">
		<div class="container">
			<div class="row">

				<div class="col-md-3" id="header-left">
					<a href="{{URL::route('/')}}">{!! Html::image('frontend/images/logo.png','', array('class' => 'logo'))!!}</a>
				</div>

				<div class="col-md-9 text-right" id="header-right">
					<nav>
						<ul>
							<li  {{ (Request::is('hotel') ? 'class=active' : '') }}><a href="{!! URL::route('hotel')!!}">{{$hotel->$title_user}}</a></li>
							<li  {{ (Request::is('conference') ? 'class=active' : '') }}><a href="{{URL::route('conference')}}">{{$conference->$title_user}}</a></li>

						@foreach(App\Category::where('status',1)->where('menu',1)->orderBy($title_user,'asc')->get() as $item)
							<li  {{ (Request::is('category/' . $item->$slug_user) ? 'class=active' : '') }}><a href="{!! URL::route('category',$item->$slug_user)!!}">{{$item->$title_user}}</a></li>
							@endforeach

							<li  {{ (Request::is('about') ? 'class=active' : '') }}><a href="{!! URL::route('about')!!}">About us</a></li>
							<li  {{ (Request::is('news') ? 'class=active' : '') }}><a href="{!! URL::route('news')!!}">News</a></li>
							<li  {{ (Request::is('contacts') ? 'class=active' : '') }}><a href="{!! URL::route('contacts')!!}">Contacts</a></li>
						</ul>
					</nav>
				</div>

			</div>
		</div>
 	</div>

</header>
