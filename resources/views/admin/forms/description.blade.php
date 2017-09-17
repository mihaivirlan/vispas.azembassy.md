<!-----------------------DESCRIPTION------------------->

<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.description')</label>

    </div>
</div>
<?php
$data = isset( $item )? $item->$description: '';
$data = old($description,$data);
?>
<div class="col-sm-10">
    <div class="form-group">
        <textarea class="form-control" rows="5"
                  name="{{$description}}" id="{{$description}}"
                  @if(isset($max_length)) maxlength="{{$max_length}}"
                  @endif >
                            {!! $data !!}
        </textarea>
    </div>
</div>

<div class="clearfix"></div>