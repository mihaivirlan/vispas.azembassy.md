@extends('admin.adminLayout')
<?php

$name_table='title_'.Lang::getLocale();
?>
@section('title')
    @if(isset($item))
       {{$item->$name_table}}
    @else
        @lang('trans.add')
    @endif
@stop

@section('content')
    @if(isset($item))
        <h1>{{$item->$name_table}}</h1>
    @else
        <h1>@lang('trans.add')</h1>
    @endif

    {!! Form::open(['files'=>'true']) !!}
    @if(isset($item))
        <input type="hidden" name="id"  value="{{$item->id}}">
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
                ?>
                    <div class="tab-pane @if(! $inc ) active @endif  tab-children tab_{!! $lang !!}" data-id="tab_{!! $lang !!}" >

                    @include('admin.forms.title')
                    @include('admin.forms.slug')
                    @include('admin.forms.meta_description')
                    @include('admin.forms.mini_description',['maxlength'=>330])
                    @include('admin.forms.description')
                </div>
                <?php $inc++;?>
            @endforeach
                <?php
                $image='image';
                ?>
                @include('admin.forms.image',['address'=>'news'])

                <div class="cleardfix"></div>
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
        });
    </script>
@stop