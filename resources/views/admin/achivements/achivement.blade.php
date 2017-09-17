@extends('admin.adminLayout')

@section('title')
    <?php
    $data=isset($item)? $item->$name_user : trans('trans.add');
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
                $name              ='name_'.$lang;
                ?>
                <div class="tab-pane @if(! $inc ) active @endif  tab-children tab_{!! $lang !!}" data-id="tab_{!! $lang !!}" >

                @include('admin.forms.name')
                </div>

                <?php $inc++;?>
            @endforeach

            <!--=====================SLIDER==========-->
                <div class="col-sm-2 text-right">
                    <div class="form-group">

                        <label class="text_right_admin">@lang('trans.value')</label>

                    </div>
                </div>
                <?php
                $data = isset( $item )? $item->value: '';
                $data = old('value',$data);
                ?>
                <div class="col-sm-10">
                    <div class="form-group">
                        <input type="number" name="value" class="form-control" value="{{$data}}" required>
                    </div>
                </div>
                <div class="clearfix"></div>
            <div class="clearfix"></div>
            @include('admin.forms.sort')
            @include('admin.forms.status')

        </div>

        <button type="submit" onclick="Save()" class="btn btn-app" style="float:right;margin-top: 30px;">
            <i class="fa fa-save"></i> @lang('trans.save')
        </button>



    </div>

    {!! Form::close() !!}
@stop

