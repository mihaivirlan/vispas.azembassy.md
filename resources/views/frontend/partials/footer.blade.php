<footer>

	<div class="container">
		<div class="row">
			<div class="col-md-3 col-xs-6">
				<h2>
					<h2>@lang('l.about_us')</h2>
				</h2>
				<div class="footer-line"></div>
				<div class="about-text">Lorem ipsum dolor sit amet, consectetuer  adipiscing elit. Aene</div>
				<div class="footer-socials">
					@if(!empty($contact->fb))<a class="facebook"  href="{{URL::to($contact->fb)}}" target="_blank" >{!! Html::image('frontend/images/icons/facebook.png')!!}</a>@endif
					@if(!empty($contact->twitter))<a class="facebook" href="{{URL::to($contact->twitter)}}" target="_blank" >{!! Html::image('frontend/images/icons/twitter.png')!!}</a>@endif
					@if(!empty($contact->google))<a class="facebook" href="{{URL::to($contact->google)}}" target="_blank" >{!! Html::image('frontend/images/icons/google.png')!!}</a>@endif
					@if(!empty($contact->ok))<a class="facebook" href="{{URL::to($contact->ok)}}" target="_blank" >{!! Html::image('frontend/images/icons/odnoklassniki.png')!!}</a>@endif
					@if(!empty($contact->wk))<a class="facebook" href="{{URL::to($contact->wk)}}" target="_blank" >{!! Html::image('frontend/images/icons/vk.png')!!}</a>@endif
				</div>

			</div>
			<div class="col-md-3 col-xs-6">
				<h2>@lang('l.our_address')</h2>
				<div class="footer-line"></div>
				<div class="address-text">
				{{$about->$mini_description_user}}
				<p>@lang('l.phone'): {{$contact->phone}}</p>
				@if(!empty($contact->fax))
					<p>@lang('l.fax'):    {{$contact->fax}}</p>
				@endif
				<p>@lang('l.email'): {{$contact->email}}</p>
				@if(!empty($contact->skype))
					<p>Skype: {{$contact->skype}}</p>
				@endif
				</div>
			</div>
			<div class="col-md-3 col-xs-6">
				<h2>
					@lang('l.last_news')
				</h2>
				<div class="footer-line"></div>
				<?php
					$news=App\News::where('status',1)->orderBy('id','desc')->take(2)->get();
                ?>
				<div class="footer-news">
					@foreach($news as $item)
					<div class="item">
						<?php

						if (file_exists(public_path().'/images/news/'.($item->id).'/'.$item->image))
                            $url=asset('images/news/'.($item->id).'/'.$item->image);
						else
                            $url=asset('img/no-image.png');
						?>
						<div class="image pull-left left">
							<img src="{!!$url!!}" alt="{{$item->$title_user}}" style="max-width: 100%">
						</div>
						<div class="pull-right right">
							<div class="date">
								{{App\Http\Controllers\DataController::getDateBlogs($item->created_at)}}
							</div>
							<div class="title">
								<a href="">{{$item->$title_user}}</a>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>

					@endforeach
				</div>

			</div>
			<div class="col-md-3 col-xs-6 footer-gallery">
				<h2>
					@lang('l.gallery')
				</h2>
				<div class="footer-line"></div>
				<div class="images">
					<?php $images = App\Http\Controllers\InstagramController::getInstaImages(); ?>
					@foreach($images as $item)
                        <img src="{!! $item !!}" alt="" width="87" class="pull-left" height="87">
					@endforeach
				</div>
				<div class="clearfix"></div>
				<div class="more-insta">
					<a href="">More on instagram</a>
				</div>
			</div>
		</div>
	</div>	
</footer>

<div class="footer-line">
	
	<div class="container">
		<div class="row">
			<div class="col-md-6  col-xs-6 text-left">2017 @if(date('Y')!=2017) {{date('Y')}} @endif VisPas. All Rights Reserved </div>
			<div class="col-md-6 col-xs-6 text-right">

				{{--	TODO: Loop throught all footer designated pages	and show	--}}

                <?php
                $page=\App\Page::find(10);
                ?>
				<a href="{!! URL::route('terms')!!}">{{$page->$title_user}}</a>
				<?php
				$page=\App\Page::find(9);
				?>
				<a href="{!! URL::route('faq')!!}">{{$page->$title_user}}</a>
                <?php
                $page=\App\Page::find(2);
                ?>
				<a href="{!! URL::route('contacts')!!}">{{$page->$title_user}}</a>
			</div>
		</div>
	</div>
</div>
<script src="{{asset('js/jquery-2.2.0.min.js')}}" type="text/javascript"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="{{asset('bootstrap/dist/js/bootstrap.js')}}"></script>
{!! Html::script('frontend/js/main.js')!!}
{!! Html::script('slick/slick.js')!!}
{!! Html::script('js/bootstrap-datepicker.js')!!}
@yield('script')
<script>
    $(document).on('ready', function() {
        partnerSlick();

        $('.datepicker').datepicker();

        $('.mobile-menu-toggle').on('click', function(){
			$('.mobile-menu').toggle();
    	});
        $(window).resize(function(){
            partnerSlick();
		})
	});
    function partnerSlick() {
		var showSlides = 5;
		var scrollSlides = 4;
		var width = $(window).width();
		if(width <480) {
		    showSlides = 1;
		    scrollSlides = 1;
		} else if(width <768) {
            showSlides = 4;
            scrollSlides = 3;
		}
        $("#partners .items").slick({
            dots: false,
            infinite: true,
            centerMode: true,
            slidesToShow: showSlides,
            slidesToScroll: scrollSlides
        });
	}

</script>
</body>

</html>