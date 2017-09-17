    @extends('admin.adminLayout')
<?php
$data=isset($item)? $item->$title_user  : trans('trans.add');
$data=old($title_user,$data);

$array_description=[1,3,5,7,8];
?>
@section('title')
    {{$data}}
@stop
@section('content')
    <h1>{{$data}}</h1>
    {!! Form::open(['files'=>'true']) !!}
    @if(isset($item))
        {!! Form::hidden('id',$item->id) !!}
    @endif
    <div class="nav-tabs-custom" >
        <ul class="nav nav-tabs">

            <?php $inc = 0;  ?>

            @foreach ($lang_data as $lang => $value)
                <li class="@if(! $inc ) active @endif">
                    <a href=".tab_{!! $lang !!}" data-toggle="tab">
                        {!! HTML::image("img/".$lang.".png") !!}
                    </a>
                    <?php $inc++; ?>
                </li>
            @endforeach

            @if(isset($tab))
                <li >
                    <a href=".tab_{{$tab['href']}}" data-toggle="tab">
                        @lang('trans.'.$tab['name'])
                    </a>
                </li>
            @endif
        </ul>

        <div class="tab-content clearfix">

            <?php $inc = 0; ?>

            @foreach ($lang_data as $lang => $value)

                <?php
                    $title='title_'.$lang;
                    $slug='slug_'.$lang;
                    $meta_description='meta_description_'.$lang;
                    $description='description_'.$lang;
                ?>

                <div class="tab-pane @if(! $inc ) active @endif  tab-children tab_{!! $lang !!}" data-id="tab_{!! $lang !!}" >

                    @include('admin.forms.title')
                    @include('admin.forms.meta_description')


                    @if(isset($item) && !in_array($item->id,$array_description))
                        @include('admin.forms.description')
                    @endif

                </div>

                <?php
                    $inc++;
                    ?>

            @endforeach

                <div class="clearfix"></div>


            <div class="clearfix"></div>

            <button type="submit" onclick="Save()"  class="btn btn-app" >
                <i class="fa fa-save"></i> @lang('trans.save')
            </button>

        </div>
    </div>
@stop

@section('script')
    <script>
        @if(!isset($item) || $item->id>2)
      $(function(){
            CKEDITOR_ADD();
        });
        @endif
    </script>
@stop