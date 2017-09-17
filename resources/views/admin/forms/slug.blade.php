<!-----------------------SLUG------------------->

<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.slug')</label>

    </div>
</div>
<?php
$data = isset( $item )? $item->$slug: '';
$data = old($slug,$data);
?>
<div class="col-sm-8">
    <div class="form-group text-left">

        <input type="text" tabindex="-1"  data-lang="{{$lang}}"  class="form-control slug_default slug_input"  name="{{$slug}}"  value="{{$data}}" @if(isset($max_length)) maxlength="{{$max_length}}" @else maxlength="255" @endif >

    </div>
</div>

<div class="col-sm-2 text-right">
    <div class="form-group">

        <button type="button" class="btn btn-adn slug_default btn_slug_{{$lang}}" onclick="Slug_Close(this,'{{$lang}}')">@lang('trans.cancel')</button>
        <button type="button" class="btn btn-default slug_default btn_slug_{{$lang}}" onclick="Slug_Save(this,'{{$lang}}')">@lang('trans.save')</button>
        <button type="button" class="btn btn-default btn_slug_change_{{$lang}}" onclick="SlugChange(this,'{{$lang}}')">@lang('trans.change')</button>

    </div>
</div>
<div class="clearfix"></div>

