@extends('admin.adminLayout')


@section('content')
    <h1>@lang('trans.contacts')</h1>

    {!! Form::open() !!}
    <div class="form-group">
        <label for="phone_contacts">@lang('trans.phone')</label>
        {!! Form::text('phone',$item->phone,['class'=>'form-control','required']) !!}
    </div>
    <div class="form-group">
        <label for="facebook">Fax</label>
        {!! Form::text('fax',$item->fax,['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        <label for="email">@lang('trans.email')</label>
        {!! Form::email('email',$item->email,['class'=>'form-control','required']) !!}
    </div>



    <div class="form-group">
        <label for="facebook">Facebook</label>
        {!! Form::url('fb',$item->fb,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="vkontakte">Vkontakte</label>
        {!! Form::url('wk',$item->wk,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="twitter">Twitter</label>
        {!! Form::url('twitter',$item->twitter,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="twitter">Google</label>
        {!! Form::url('google',$item->google,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="twitter">Ok</label>
        {!! Form::url('ok',$item->ok,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="twitter">Skype</label>
        {!! Form::text('skype',$item->skype,['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        <label for="twitter">Map</label>
        {!! Form::textarea('map',$item->map,['class'=>'form-control','required','rows'=>3]) !!}
    </div>
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