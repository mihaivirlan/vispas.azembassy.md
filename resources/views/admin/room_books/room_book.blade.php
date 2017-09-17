@extends('admin.adminLayout')


@section('content')
    <h1>@lang('trans.room_books')</h1>

    {!! Form::open() !!}
    @if(isset($item))
        {!! Form::hidden('id',$item->id) !!}
    @endif
   <?php
    $name='name';

   ?>

    @include('admin.forms.name')
    <div class="col-sm-2 text-right">
        <div class="form-group">

            <label class="text_right_admin">@lang('trans.phone')</label>

        </div>
    </div>
    <?php
    $data = isset( $item )? $item->phone: '';
    $data = old('phone',$data);
    ?>
    <div class="col-sm-10">
        <div class="form-group">

            <input type="text" class="form-control" name="phone"  value="{{$data}}" required >

        </div>
    </div>
    <div class="clearfix"></div>
    <!--==================STATUS============-->
    <!-----------------------DESCRIPTION------------------->

    <div class="col-sm-2 text-right">
        <div class="form-group">

            <label class="text_right_admin">@lang('trans.message')</label>

        </div>
    </div>
    <?php
    $data = isset( $item )? $item->comment: '';
    $data = old('comment',$data);
    ?>
    <div class="col-sm-10">
        <div class="form-group">
            <textarea class="form-control" rows="5" name="comment"  maxlength="255">{!! $data !!}</textarea>
        </div>
    </div>

    <div class="clearfix"></div>


    <div class="col-sm-2 text-right">
        <div class="form-group">

            <label class="text_right_admin">@lang('trans.rooms')</label>

        </div>
    </div>

    <?php
    $data = isset( $item )? $item->id_room: 0;
    $data = old('id_room',$data);
    ?>
    <div class="col-sm-10">
        <div class="form-group">
            <select name="id_room" class="select2" required>
              @foreach(\App\HotelRoom::where('status',1)->orderBy($title_user,'asc')->get() as $it)
                  <option value="{{$it->id}}">{{$it->$title_user}}</option>
              @endforeach
            </select>
        </div>
    </div>
    <div class="clearfix"></div>

    @include('admin.forms.status')
    <div class="form-group">
        <button type="submit" class="btn btn-primary top_button_admin"  style="float: right">@lang('trans.submit') </button>
    </div>
    {!! Form::close() !!}

@stop

@section('style')
    <style>
        #form_settings .form-group{
            width:450px ;
        }
    </style>

@stop

@section('script')
    {!! HTML::script('js/select2.min.js') !!}
    <script>
        $(function(){
            select('.select2');
        })
        function select(th){

            $(th).select2({width:'100%'});

        }
    </script>
@stop