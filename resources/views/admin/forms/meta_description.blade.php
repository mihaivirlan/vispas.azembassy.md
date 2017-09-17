<!-----------------------METADESCRIPTION------------------->

<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.meta_description')</label>

    </div>
</div>
<?php
$data = isset( $item )? $item->$meta_description: '';
$data = old($meta_description,$data);
?>
<div class="col-sm-10">
    <div class="form-group">

        <input type="text" class="form-control" name="{{$meta_description}}"  value="{{$data}}"   maxlength="255">

    </div>
</div>
<div class="clearfix"></div>