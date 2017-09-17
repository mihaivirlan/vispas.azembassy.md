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
				<div class="col-md-9  col-xs-12">
					<div class="block">
					<div class="slider">
						<div class="image-large">
                            <?php
                            if (file_exists(public_path().'/images/hotel_rooms/'.($item->id).'/'.$item->image_1))
                                $url=asset('images/hotel_rooms/'.($item->id).'/'.$item->image_1);
                            else
                                $url=asset('img/no-image.png');
                            ?>
							<img src="{{$url}}">
						</div>
						<div class="thumbnails">
                            <?php
                            if (file_exists(public_path().'/images/hotel_rooms/'.($item->id).'/'.$item->image_1))
                                $url=asset('images/hotel_rooms/'.($item->id).'/'.$item->image_1);
                            else
                                $url=asset('img/no-image.png');
                            ?>
							<img src="{{$url}}">
								@for($inc=2;$inc<=4;$inc++)
									<?php $image='image_'.$inc;?>
									@if(!empty($item->$image))
										<?php
										if (file_exists(public_path().'/images/hotel_rooms/'.($item->id).'/'.$item->$image))
											$url=asset('images/hotel_rooms/'.($item->id).'/'.$item->$image);
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
				<div class="col-md-3 col-xs-12 ">
				<div class="block element-description">
				  <div class="service">
				  	  <h3>@lang('l.service')</h3>
				  	  <div class="line"></div>
				  	  <div class="service-list">
				  	  		{!! $item->$service_user !!}
				  	  </div>
				  </div>
				 <div class="price">
						<h3>@lang('l.price')</h3>
						<div class="line"></div>
						<p> <span>{{$item->price}}$ / @lang('l.night') </span></p>
					 <br/>
					 <button class="button" data-toggle="modal" data-target="#book-now">@lang('l.book_now')</button>
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
						<h3>@lang('l.detail')</h3>
						<div class="line"></div>
					</div>
				</div>
				<div class="details">
					{!! $item->$description_user !!}
				</div>
			</div>

		</div>
		<!-- end details -->
		@if(count($items))
			<div id="our-rooms">
				<div class="container">
					<h3>@lang('l.our_rooms')</h3>
					<div class="line"></div>
				</div>
				<div class="rooms">
					<div class="container">
						<div class="row">
							@foreach($items as $item)
                                <?php
                                if (file_exists(public_path().'/images/hotel_rooms/'.($item->id).'/'.$item->image_1))
                                    $url=asset('images/hotel_rooms/'.($item->id).'/'.$item->image_1);
                                else
                                    $url=asset('img/no-image.png');
                                ?>
								<div class="col-md-4 col-xs-6">
									<div class="room-item">
										<div class="image">
											{!! Html::image($url)!!}
										</div>
										<div class="padding">
											<p class="title"><a href="{{URL::route('room',$item->$slug_user)}}">{{$item->$title_user}}</a></p>
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
	<!-- Modal -->
		<div class="modal fade" id="book-now" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">@lang('l.book_now')</h4>
					</div>
					<div class="modal-body">
						{!! Form::open() !!}
						{!! Form::hidden('id_room',$item->id) !!}
						<div class="form-group">
							<label>@lang('l.name')</label>
							<input type="text" name="name" class="form-control" maxlength="50" required />
						</div>
						<div class="form-group">
							<label>@lang('l.phone')</label>
							<input type="text" name="phone" maxlength="20" class="form-control" required />
						</div>
						<div class="form-group">
							<label>@lang('l.comment')</label>
							<textarea maxlength="500"  name="comment" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<button class="button">@lang('l.book_now')</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>



@stop