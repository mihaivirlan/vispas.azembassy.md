<!-----------------------Title------------------->

<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.title')</label>

    </div>
</div>
<?php
$data = isset( $item )? $item->$title: '';
$data = old($title,$data);
?>
<div class="col-sm-10">
    <div class="form-group">

        <input type="text" class="form-control input_slug" name="{{$title}}" data-lang="{{$lang}}" value="{{$data}}"  @if(isset($max_length)) maxlength="{{$max_length}}" @else maxlength="255" @endif required>

    </div>
</div>
<div class="clearfix"></div>