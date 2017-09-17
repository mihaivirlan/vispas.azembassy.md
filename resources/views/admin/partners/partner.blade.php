@extends('admin.adminLayout')

@section('title')
    <?php
    $data=isset($item)? $item->url : trans('trans.add');
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


        <div class="tab-content">
            <?php $url='url';?>
            @include('admin.forms.url')
                <?php $image='image';?>
                @include('admin.forms.image',['address'=>'partners'])
            @include('admin.forms.sort')
            <div class="cleardfix"></div>
            @include('admin.forms.status')

        </div>

        <button type="submit"  class="btn btn-app" style="float:right;margin-top: 30px;">
            <i class="fa fa-save"></i> @lang('trans.save')
        </button>



    </div>

    {!! Form::close() !!}
@stop

