@extends('admin.adminLayout')<?php    $lang=Lang::getLocale();    $name='name_'.$lang;    $data = isset( $item )? $item->$name: trans('trans.add');    $data = old($name,$data);?>@section('title')    {{$data}}@stop@section('style')    <style>        .text_right_admin{            padding-top: 5px;        }    </style>@stop@section('content')    <h1>{{$data}}</h1>    {!! Form::open(['files'=>'true']) !!}    @if(isset($item))    {!! Form::hidden('id',$item->id) !!}    @endif    <div class="nav-tabs-custom" >        <ul class="nav nav-tabs">            <?php $inc = 0;  ?>                @foreach ($lang_data as $lang => $value)                <li class="@if(! $inc ) active @endif">                    <a href=".tab_{!! $lang !!}" data-toggle="tab">                        {!! HTML::image("img/".$lang.".png") !!}                    </a>                    <?php $inc++;?>                </li>            @endforeach        </ul>        <div class="tab-content">            <?php            $inc = 0;            ?>            @foreach ($lang_data as $lang => $value)                <?php                    $url='url_'.$lang;                    $text='text_'.$lang;                    $name='name_'.$lang;                ?>                <div class="tab-pane @if(! $inc ) active @endif  tab-children tab_{!! $lang !!}" data-id="tab_{!! $lang !!}" >                <div class="col-sm-2 text-right">                        <div class="form-group">                            <label class="text_right_admin">@lang('trans.name')</label>                        </div>                    </div>                    <?php                        $data = isset( $item )? $item->$name: '';                        $data = old($name,$data);                    ?>                    <div class="col-sm-10 ">                        <div class="form-group">                            <input type="text" maxlength="170" class="form-control" name="{{$name}}"  value="{{$data}}" >                        </div>                    </div>                    <!-----------------------TEXT------------------->                    <div class="col-sm-2 text-right">                        <div class="form-group">                            <label class="text_right_admin">@lang('trans.text')</label>                        </div>                    </div>                    <?php                    $data = isset( $item )? $item->$text: '';                    $data = old($text,$data);                    ?>                    <div class="col-sm-10">                        <div class="form-group">                            <textarea  class="form-control" name="{{$text}}"  maxlength="300">{{$data}}</textarea>                        </div>                    </div>                    <!----------------------------URL------------------------>                    <div class="col-sm-2 text-right">                        <div class="form-group">                            <label class="text_right_admin">@lang('trans.url')</label>                        </div>                    </div>                    <?php                    $data = isset( $item )? $item->$url: '';                    $data = old($url,$data);                    ?>                    <div class="col-sm-10">                        <div class="form-group">                            <input type="text" class="form-control" name="{{$url}}"  value="{{$data}}" >                        </div>                    </div>                </div>                <?php $inc++;?>            @endforeach                    <?php $image='image';?>                    <div class="col-sm-2 text-right">                        <div class="form-group">                            <label class="text_right_admin">@lang('trans.image')</label>                        </div>                    </div>                    <?php                    if(isset($item)){                        $t='';                    }else{                        $t='required';                    }                    $data = isset( $item )? $item->$image: '';                    $data = old($image,$data);                    ?>                    <div class="col-sm-10">                        <div class="form-group">                            {!! Form::file($image,['accept'=>'image/*','single',$t]) !!}                        </div>                    </div>                    @if(isset($item))                        <div class="col-sm-2 text-right">                        </div>                        <div class="col-sm-10">                            <div class="image_admin">                                @if(file_exists(public_path().'/images/slider/'.($item->id).'/'.$item->$image))                                    {!! HTML::image('/images/slider/'.($item->id).'/'.$item->$image)!!}                                @else                                    {!! HTML::image('/img/no-image.png') !!}                                @endif                            </div>                        </div>                    @endif                <div class="clearfix"></div>                <div class="col-sm-2 text-right">                    <div class="form-group">                        <label class="text_right_admin">@lang('trans.sort')</label>                    </div>                </div>                <?php                $data = isset( $item )? $item->sort: '';                $data = old('sort',$data);                ?>                <div class="col-sm-10">                    <div class="form-group">                        <input type="number" name="sort" class="form-control" value="{{$data}}" >                    </div>                </div>                <div class="col-sm-2 text-right">                    <div class="form-group">                        <label class="text_right_admin">@lang('trans.status')</label>                    </div>                </div>                <?php                $data = isset( $item )? $item->status: 0;                $data = old('status',$data);                ?>                <div class="col-sm-10">                    <div class="form-group">                        <select name="status" class="form-control">                            <option value="1" @if($data) selected @endif>@lang('trans.on')</option>                            <option value="0">@lang('trans.off')</option>                        </select>                    </div>                </div>        </div>        <div class="clearfix"></div>        <button type="submit" onclick="Save()"  class="btn btn-app" >            <i class="fa fa-save"></i> @lang('trans.save')        </button>    </div>@stop