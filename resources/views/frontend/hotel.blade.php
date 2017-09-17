@extends('frontend.body')
@section('title')
	<title>{{$page->$title_user}}</title>
	<meta name="description" content="{{$page->$meta_description_user}}">
@stop
@section('content')
	<section id="hotel-rooms">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="title">@lang('l.hotel_rooms')</h2>
					<div class="line-title"></div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				@foreach($items as $item)
                    <?php
                    if (file_exists(public_path().'/images/hotel_rooms/'.($item->id).'/'.$item->image_1))
                        $url=asset('images/hotel_rooms/'.($item->id).'/'.$item->image_1);
                    else
                        $url=asset('img/no-image.png');
                    ?>
					<div class="col-md-4 col-xs-12 clas_titlu">
						<div class="room">
							<div class="image">
								<a href="{{URL::route('room',$item->$slug_user)}}">
									<img src="{{$url}}" alt="{{$item->$title_user}}">
								</a>
							</div>
							<div class="item-padding">
								<p class="item-title"><a href="{{URL::route('room',$item->$slug_user)}}">{{$item->$title_user}}</a></p>
								<div class="line"></div>
								<div class="description">
								{{$item->$mini_description_user}}
								</div>
								</div>
							<div class="triangle"></div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="text-center">

			@include('pagination',['paginator'=>$items])

		</div>
	</section>
@stop