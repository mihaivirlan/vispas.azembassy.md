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
                <div class="col-md-9 col-xs-12">
                <div class="block">
                    <div class="slider">
                        <div class="image-large">
                            <?php
                            if (file_exists(public_path().'/images/categories/'.($item->id).'/'.$item->image_1))
                                $url=asset('images/categories/'.($item->id).'/'.$item->image_1);
                            else
                                $url=asset('img/no-image.png');
                            ?>
                            <img src="{{$url}}">
                        </div>
                        <div class="thumbnails">
                            <?php
                            if (file_exists(public_path().'/images/categories/'.($item->id).'/'.$item->image_1))
                                $url=asset('images/categories/'.($item->id).'/'.$item->image_1);
                            else
                                $url=asset('img/no-image.png');
                            ?>
                            <img src="{{$url}}">
                            @for($inc=2;$inc<=4;$inc++)
                                <?php $image='image_'.$inc;?>
                                @if(!empty($item->$image))
                                    <?php
                                    if (file_exists(public_path().'/images/categories/'.($item->id).'/'.$item->$image))
                                        $url=asset('images/categories/'.($item->id).'/'.$item->$image);
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
                <div class="col-md-3  col-xs-12">
                    <div class="service block">
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

    </section>
@stop