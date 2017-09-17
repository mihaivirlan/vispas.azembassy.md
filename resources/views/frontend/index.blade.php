@extends('frontend.body')
@section('title')
	<title>{{$page->$title_user}}</title>
	<meta name="description" content="{{$page->$meta_description_user}}">
@stop
@section('content')
	<section id="slider">

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  	<?php $inc= 0; ?>
    @foreach($sliders as $item)
      	<li  class="@if(!$inc) active @endif" data-target="#mycarousel" data-slide-to="{!! $inc !!}"></li>
		 <?php $inc++;?>
  	@endforeach


  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
	  <?php
	  $inc=0;
	  ?>
	  @foreach($sliders as $item)
		  <?php
			  if(file_exists(public_path().'/images/slider/'.($item->id).'/'.$item->image)){
                  $url=asset('images/slider/'.($item->id).'/'.$item->image);
              }
			  else{
                  $url=asset('img/no-image.png');

              }
		  ?>
			<div class="item @if(!$inc) active @endif" style="background-image: url('{{$url}}')">
			<!--	<img src="{{$url}}">  -->
			</div>
		  <?php $inc++;?>
	  @endforeach
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</section>

<section id="filter" class="border-bottom">
		<div class="container">
			<div class="flex-center">
				<div class="filter-date  filter-padding-top filter-items-margin-right">
					<input type="text" name="date" value="" placeholder="Date" class="pull-left no-focus datepicker">
					<button class="filter-date-btn filter-btn inline-block no-focus pull-left"></button>
				</div>
				<div class="filter-departure filter-padding-top  filter-items-margin-right pull-left">
					<input type="text" name="date" value="" placeholder="Departure" class="pull-left no-focus datepicker">
					<button class="filter-departure-btn filter-btn  inline-block no-focus"></button>
				</div>
				<div class="filter-children filter-padding-top filter-items-margin-right">
					<select id="soflow">
						<!-- This method is nice because it doesn't require extra div tags, but it also doesn't retain the style across all browsers. -->
						<option>Select an Option</option>
						<option>Option 1</option>
						<option>Option 2</option>
					</select>
				</div>
				<div class="pull-left filter-padding-top">
				<button class="filter-check-btn">
					<a href="{{URL::route('booking')}}">Check Availability</a>
				</button>
				</div>
			</div>
		</div>
</section>


<section class="index-offerts">
	<div class="container">
		<div class="row">
			@foreach($categories as $item)
                <?php
                if (file_exists(public_path().'/images/categories/'.($item->id).'/'.$item->image_1))
                    $url=asset('images/categories/'.($item->id).'/'.$item->image_1);
                else
                    $url=asset('img/no-image.png');
                ?>
				<div class="col-sm-4 col-xs-6 col-lg-3">
					<div class="item relative">
					<div class="image">
						<a href="{{URL::route('category',$item->$slug_user)}}"> <img src="{{$url}}" alt=""></a>
					</div>
					<div class="d-content">
						<h3><a href="{{URL::route('category',$item->$slug_user)}}"> {{$item->$title_user}}</a></h3>
						<div class="line"></div>
						<div class="desc">
						{{$item->$mini_description_user}}
						</div>
						</div>
					<div class="triangle"></div>
					</div>

				</div>
			@endforeach

		</div>

	</div>

</section>


<section id="achievements" class="border-bottom">
	<div class="container">
		<h2>@lang('trans.achievements')</h2>
		<div class="row">
			@foreach($achievements as $item)
			<div class="col-md-3 col-xs-3">
				<div class="item">
					<div class="number">{{$item->value}}</div>
					<div class="text">{{$item->$name_user}}</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

</section>

<section id="news">
	<div class="container">
	<h2>
		@lang('l.news')
	</h2>		
	<div class="news-line"></div>
	<div class="row">
		@foreach($news as $item)
			<div class="col-md-4">
				<div class="item relative red">
					<div class="date">{{App\Http\Controllers\DataController::getDateBlogs($item->created_at)}}</div>
					<h3><a href="">{{$item->$title_user}}</a></h3>
					<div class="line-white"></div>
					<div class="desc">
						{{$item->$mini_description_user}}
					</div>
					<div class="triangle-white"></div>
				</div>
			</div>
		@endforeach

	</div>

	</div>
</section>

<section id="s-page" class="border-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>{{$page_index->$title_user}}</h3>
				<p>
					{{$page_index->$mini_description_user}}
				</p>
			</div>
			<div class="col-md-4">
				<a href="{{URL::route('page',$page_index->$slug_user)}}" class="btn-custom">@lang('l.read_more')</a>
			</div>
		</div>
	</div>	
</section>

<section id="partners">
	<div class="container">
		<h2>@lang('l.partners')</h2>
		<div class="partners-line"></div>
		<div class="items">
		@foreach($partners as $item)
              <div>
                <?php
                if (file_exists(public_path().'/images/partners/'.($item->id).'/'.$item->image))
                    $url=asset('images/partners/'.($item->id).'/'.$item->image);
                else
                    $url=asset('img/no-image.png');
                ?>
				<img src="{{$url}}" alt="">

			  </div>
		@endforeach
		</div>
	</div>
</section>
@stop