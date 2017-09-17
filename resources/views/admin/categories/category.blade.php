@extends('admin.adminLayout')

@section('title')
    <?php
    $data=isset($item)? $item->$title_user : trans('trans.add');
    ?>
    {{$data}}
@stop

@section('content')
    <h1> {{$data}}</h1>
    {!! Form::open(['files'=>'true']) !!}
    @if(isset($item))
        {!! Form::hidden('id',$item->id) !!}
    @endif
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <?php $inc = 0;  ?>
            @foreach($lang_data as $lang =>$value )
                <li class="@if(! $inc ) active @endif tab_{{$lang}}">
                    <a href=".tab_{!! $lang !!}" data-toggle="tab" >
                        {!! HTML::image("img/".$lang.".png") !!}
                    </a>
                    <?php $inc++;?>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            <?php
            $inc = 0;
            ?>
            @foreach($lang_data as $lang=>$value )

                <?php
                $title              ='title_'.$lang;
                $slug               ='slug_'.$lang;
                $meta_description   ='meta_description_'.$lang;
                $description        ='description_'.$lang;
                $mini_description   ='mini_description_'.$lang;
                $service   ='service_'.$lang;
                ?>
                <div class="tab-pane @if(! $inc ) active @endif  tab-children tab_{!! $lang !!}" data-id="tab_{!! $lang !!}" >

                @include('admin.forms.title')
                @include('admin.forms.slug')
                @include('admin.forms.meta_description')
                @include('admin.forms.mini_description',['maxlength'=>255])
                <!-----------------------DESCRIPTION------------------->

                    <div class="col-sm-2 text-right">
                        <div class="form-group">

                            <label class="text_right_admin">@lang('trans.service')</label>

                        </div>
                    </div>
                    <?php
                    $data = isset( $item )? $item->$service: '';
                    $data = old($service,$data);
                    ?>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" name="{{$service}}" id="{{$service}}" >{!! $data !!}</textarea>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    @include('admin.forms.description')
                </div>
                <?php $inc++;?>
            @endforeach

            <?php  $address='categories';?>
            @for($inc=1;$inc<=4;$inc++)
                <?php
                $image='image_'.$inc;
                ?>
                <div class="col-sm-2 text-right">
                    <div class="form-group">

                        <label class="text_right_admin">@lang('trans.image') {{$inc}}</label>

                    </div>
                </div>
                <?php
                if(!isset($item) && $inc==1){
                    $t='required';
                }else {
                    $t='';
                }
                $data = isset( $item )? $item->$image: '';
                $data = old($image,$data);
                ?>
                <div class="col-sm-10">
                    <div class="form-group">
                        {!! Form::file($image,['accept'=>'image/*','single',$t]) !!}
                    </div>
                </div>
                @if(isset($item) && !empty($item->$image))
                    <div class="col-sm-2 text-right">
                    </div>
                    <div class="col-sm-10">
                        <div class="image_admin">
                            @if(file_exists(public_path().'/images/'.$address.'/'.($item->id).'/'.$item->$image))
                                {!! HTML::image('/images/'.$address.'/'.($item->id).'/'.$item->$image)!!}
                            @else
                                {!! HTML::image('/img/no-image.png') !!}
                            @endif
                        </div>
                    </div>
                @endif

                <div class="clearfix"></div>
            @endfor

            @include('admin.forms.sort')
            <div class="cleardfix"></div>
                <!--==================STATUS============-->

                <div class="col-sm-2 text-right">
                    <div class="form-group">

                        <label class="text_right_admin">@lang('trans.menu')</label>

                    </div>
                </div>

                <?php
                $data = isset( $item )? $item->menu: 0;
                $data = old('menu',$data);
                ?>
                <div class="col-sm-10">
                    <div class="form-group">
                        <select name="menu" class="form-control">
                            <option value="0">@lang('trans.off')</option>
                            <option value="1" @if($data==1) selected @endif>@lang('trans.on')</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>

                @include('admin.forms.status')

        </div>

        <button type="submit" onclick="Save()" class="btn btn-app" style="float:right;margin-top: 30px;">
            <i class="fa fa-save"></i> @lang('trans.save')
        </button>



    </div>

    {!! Form::close() !!}
@stop

@section('script')
    <script>
        $(function(){
            CKEDITOR_ADD();
            @foreach( $lang_data as $lang =>$value )
                CKEDITOR.replace('service_{{$lang}}', {height: 200});
            @endforeach
        });
    </script>
@stop