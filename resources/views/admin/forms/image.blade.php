<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.image')</label>

    </div>
</div>
<?php
if(isset($item)){
    $t='';
}else{
    $t='required';
}
$data = isset( $item )? $item->$image: '';
$data = old($image,$data);
?>
<div class="col-sm-10">
    <div class="form-group">
        {!! Form::file($image,['accept'=>'image/*','single',$t]) !!}
    </div>
</div>
@if(isset($item))
    <div class="col-sm-2 text-right">
    </div>
    <div class="col-sm-10">
        <div class="image_admin">
            @if(file_exists(public_path().'/images/'.$address.'/'.($item->id).'/'.$item->$image))
                {!! HTML::image('/images/'.$address.'/'.($item->id).'/'.$item->$image)!!}
            @else
                {!! HTML::image('/img/no-image.png') !!}
            @endif
        </div>
    </div>
@endif

<div class="clearfix"></div>