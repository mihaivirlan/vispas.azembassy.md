@extends('frontend.body')
@section('title')

@stop
@section('content')
	<section id="news">
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
					@foreach($news as $item)
						<div class="col-sm-12">
							<div class="news-item">
								<a href="{{URL::Route('news',$item->$slug_user)}}">{{$item->$title_user}}</a>
								<div class="description">
									{{$item->$mini_description_user}}
								</div>
							</div>
						</div>
					@endforeach

						<div class="text-center">

							@include('pagination',['paginator'=>$news])

						</div>
				</div>	



			</div>
				
	</section>
@stop

@section('script')

	<script>
		$(function(){

		})
	</script>
@stop