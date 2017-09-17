
<!--=====================SLIDER==========-->
<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.sort')</label>

    </div>
</div>
<?php
$data = isset( $item )? $item->sort: '';
$data = old('sort',$data);
?>
<div class="col-sm-10">
    <div class="form-group">
        <input type="number" name="sort" class="form-control" value="{{$data}}" >
    </div>
</div>
<div class="clearfix"></div>