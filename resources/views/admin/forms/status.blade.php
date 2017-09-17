<!--==================STATUS============-->

<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.status')</label>

    </div>
</div>

<?php
$data = isset( $item )? $item->status: 1;
$data = old('status',$data);
?>
<div class="col-sm-10">
    <div class="form-group">
        <select name="status" class="form-control">
            <option value="0">@lang('trans.off')</option>
            <option value="1" @if($data==1) selected @endif>@lang('trans.on')</option>
        </select>
    </div>
</div>
<div class="clearfix"></div>
