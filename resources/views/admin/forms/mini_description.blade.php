<!-----------------------MINIDESCRIPTION------------------->

<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.mini_description')</label>

    </div>
</div>
<?php
$data = isset( $item )? $item->$mini_description: '';
$data = old($mini_description,$data);
?>
<div class="col-sm-10">
    <div class="form-group">
        <textarea class="form-control" rows="3" name="{{$mini_description}}" @if(isset($max_length)) maxlength="{{$max_length}}"  @endif>{!! $data !!}</textarea>
    </div>
</div>

<div class="clearfix"></div>