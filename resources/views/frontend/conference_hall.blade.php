@extends('frontend.body')
@section('title')
	<title>{{$item->$title_user}}</title>
	<meta name="description" content="{{$item->$meta_description_user}}">
@stop
@section('content')
	<section id="room">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 id="page-title">
						{{$item->$title_user}}
					</h1>
					<div class="line-title"></div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
				<div class="block">
					<div class="slider">
						<div class="image-large">
                            <?php
                            if (file_exists(public_path().'/images/conference_halls/'.($item->id).'/'.$item->image_1))
                                $url=asset('images/conference_halls/'.($item->id).'/'.$item->image_1);
                            else
                                $url=asset('img/no-image.png');
                            ?>
							<img src="{{$url}}">
						</div>
						<div class="thumbnails">
                            <?php
                            if (file_exists(public_path().'/images/conference_halls/'.($item->id).'/'.$item->image_1))
                                $url=asset('images/conference_halls/'.($item->id).'/'.$item->image_1);
                            else
                                $url=asset('img/no-image.png');
                            ?>
							<img src="{{$url}}">
								@for($inc=2;$inc<=4;$inc++)
									<?php $image='image_'.$inc;?>
									@if(!empty($item->$image))
										<?php
										if (file_exists(public_path().'/images/conference_halls/'.($item->id).'/'.$item->$image))
											$url=asset('images/conference_halls/'.($item->id).'/'.$item->$image);
										else
											$url=asset('img/no-image.png');
										?>
										<img src="{{$url}}">
									@endif
								@endfor
						</div>
					</div>
					</div>
				</div>
				<div class="col-sm-3 block">
				  <div class="service">
				  	  <h3>@lang('l.service')</h3>
				  	  <div class="line"></div>
				  	  <div class="service-list">
				  	  		{!! $item->$service_user !!}
				  	  </div>
				  </div>

			</div>
		</div>
		</div>

		<!-- details -->
		<div id="details">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3>@lang('trans.detail')</h3>
						<div class="line"></div>
					</div>
				</div>
				<div class="details">
				{!! $item->$description_user !!}</div>
			</div>

		</div>
		<!-- end details -->
@if(count($items))
		<div id="our-rooms">
			<div class="container">
				<h3>@lang('trans.our_conferential')</h3>
				<div class="line"></div>
			</div>

			<div class="rooms">
				<div class="container">
					<div class="row">
						@foreach($items as $item)
							<?php
                            if (file_exists(public_path().'/images/conference_halls/'.($item->id).'/'.$item->image_1))
                                $url=asset('images/conference_halls/'.($item->id).'/'.$item->image_1);
                            else
                                $url=asset('img/no-image.png');
                            ?>

							<div class="col-sm-4">
								<div class="room-item">
									<div class="image">
										{!! Html::image($url)!!}
									</div>
									<div class="padding">
										<p class="title"><a href="{{URL::Route('conference',$item->$slug_user)}}">{{$item->$title_user}}</a></p>
										<div class="line"></div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
@endif
	</section>
@stop