@extends('admin.adminLayout')

@section('title')
    @lang('trans.pages')
@stop
<?php
$title='title_'.Lang::getLocale();
$name='name_'.Lang::getLocale();
?>
@section('style')
    <style>
        table tr td{
            width: 100px;
        }
        table tr td:nth-child(1){
            width: auto;
        }
    </style>
@stop
@section('content')
    <?php
    $array_no_sort=[1,2];
    ?>

    {{-- #MihaiVirlan Implemented Add Button    --}}

    <h1>@lang('trans.pages')</h1>
    <a href="{{URL::route('admin/pages/add')}}">
        <span type="button" class="btn btn-primary top_button_admin" data-toggle="modal" data-target="#addPages">
            <span class="glyphicon glyphicon-plus"></span> {{ trans('trans.add') }}
        </span>
    </a>

    <table class="table table-bordered table-striped" >
        <thead>
        <tr>
            <td>@lang('trans.title')</td>
            <td>@lang('trans.action')</td>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{$item->$title}} </td>
                <td>
                    <a href="{{URL::route('admin/page',$item->id)}}">
                        <div data-toggle="modal" data-target="#edit_{{$item->id}}" class="edit-pencil btn btn-xs btn-primary">
                            <span  class="glyphicon glyphicon-pencil"></span>
                        </div>
                    </a>
                    <a href="{{URL::route('admin/pages/delete',$item->id)}}">
                    <div data-toggle="modal" data-target="#delete_{{$item->id}}" class="edit-pencil btn btn-xs btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </div>
                    </a>
                    @if($item->type!=1)
                        <!--END EDIT MODAL -->

                            <!--DELETE SLIDER-->

                            <div class="modal fade" tabindex="-1" role="dialog" id="delete_{{ $item->id }}">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">{{ str_limit($item->id,17) }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{ trans('trans.sure-delete') }} - <strong>{{ str_limit($item->id,17) }}</strong> ?
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

                            <!--END DELETE SLIDER-->
                    @endif
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
@stop



