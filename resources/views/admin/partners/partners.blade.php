@extends('admin.adminLayout')

@section('title')
    @lang('trans.partners')
@stop
<?php
    $address='partners';
    $image='image';

?>
@section('style')

    <style>
        table tr td:nth-child(3){width: 100px;}
        table tr td:nth-child(4){width: 100px;}
    </style>
@stop
@section('content')
    <h1>@lang('trans.partners')</h1>

    <a href="{{URL::route('admin/partner')}}" style="color:#fff;">
        <button type="button" class="btn btn-primary top_button_admin">
            <span class="glyphicon glyphicon-plus"></span> {{ trans('trans.add') }}
        </button>
    </a>

    <div class="box">
        <div class="box-body">
            <table id="news" class="table table-bordered">
                <thead>
                <tr>
                    <th>@lang('trans.image')</th>
                    <th>@lang('trans.sort')</th>
                    <th class="text-center" > @lang('trans.action')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            <div class="image_admin">
                                @if(file_exists(public_path().'/images/'.$address.'/'.($item->id).'/'.$item->$image))
                                    {!! HTML::image('/images/'.$address.'/'.($item->id).'/'.$item->$image)!!}
                                @else
                                    {!! HTML::image('/img/no-image.png') !!}
                                @endif
                            </div>
                        </td>
                        <td>{{  $item->sort }}</td>
                        <td class="text-center">
                            <a href="{{URL::route('admin/partner',$item->id)}}" class="edit-pencil btn btn-xs btn-primary" title="{{ trans('trans.edit') }}">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <div data-toggle="modal" data-target="#delete_{{$item->id}}" class="delete-trash btn btn-xs btn-danger">
                                <span  class="glyphicon glyphicon-trash"></span>
                            </div>

                            <!--DELETE NEWS-->

                            <div class="modal fade" tabindex="-1" role="dialog" id="delete_{{ $item->id }}">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"> &nbsp;</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{ trans('trans.sure-delete') }}?
                                        </div>
                                        <div class="modal-footer">
                                            <div class="clearfix"></div>
                                            {!! Form::open(['method' => 'DELETE']) !!}
                                            {!! Form::hidden('id', $item->id) !!}
                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('trans.cancel') }}</button>
                                            <button type="submit" class="btn btn-warning">{{ trans('trans.delete') }}</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <!--END DELETE NEWS-->


                        </td>
                        <td class="status">@if( $item->status ) <span class="active" style="color: transparent;margin: 0 auto;">1</span> @else <span class="no-active" style="color: transparent;margin: 0 auto;">0</span>@endif </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->



@stop


