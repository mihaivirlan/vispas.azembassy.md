<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.url')</label>

    </div>
</div>
<?php
$data = isset( $item )? $item->$url: '';
$data = old($url,$data);
?>
<div class="col-sm-10">
    <div class="form-group">

        <input type="url" class="form-control" name="{{$url}}"  value="{{$data}}" @if(isset($required)) required @endif >

    </div>
</div>
<div class="clearfix"></div>