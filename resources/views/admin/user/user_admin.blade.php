@extends('admin.adminLayout')
@section('title')
    {{ trans('trans.admin') }}

@stop
@section('style')
    {!! HTML::style('/css/dataTables.bootstrap.css') !!}

    <style>

        #list_user tr td:nth-child(1){
            width: 250px;
        }
        #list_user tr td:nth-child(2){
            width: 250px;
        }
        #list_user tr td:nth-child(3){
            width: 100px;
        }
        #list_user tr td:nth-child(4){
            width: 200px;
        }
        #list_user tr td:nth-child(5){
            width: 200px;
        }
        #list_user tr td:nth-child(6){
            width: 10px;
        }
    </style>
@stop
@section('content')
    <div class="col-xs-12">
        <h1 class="page-header">
            {{ trans('trans.admin') }}
        </h1>

        <a href="{!! URL::route('admin/register') !!}"><button type="button" class="btn btn-primary top_button_admin" data-toggle="modal" data-target="#add">@lang('trans.add')</button></a>


        <table class="table  table-hover" id="users">
            <thead>
            <tr>
                <th>{{ trans('trans.admin') }}</th>
                <th>{{ trans('trans.email') }}</th>
                <th class="text-center" width="10%">{{ trans('trans.action') }}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td >{!! $admin->name !!} </td>
                    <td>{!! $admin->email !!}</td>

                    <td class="text-center">
                        <button data-toggle="modal" data-target="#edit_{{$admin->id}}" class="edit-pencil btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>

                    @if(!$admin->type)

                        <div data-toggle="modal" data-target="#delete_{{$admin->id}}" class="delete-trash btn btn-xs btn-danger">
                            <span  class="glyphicon glyphicon-trash"></span>
                        </div>

                        <!--DELETE SLIDER-->

                        <div class="modal fade" tabindex="-1" role="dialog" id="delete_{{ $admin->id }}">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">&nbsp;</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{$admin->name}}   {{ trans('trans.sure-delete') }}?
                                    </div>
                                    <div class="modal-footer">
                                        <div class="clearfix"></div>
                                        {!! Form::open(['method' => 'DELETE']) !!}
                                        {!! Form::hidden('id', $admin->id) !!}
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
                <div class="modal fade" tabindex="-1" role="dialog" id="edit_{{ $admin->id }}">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">{{ $admin->email }}</h4>
                            </div>
                            {!! Form::open(['id'=>'form_'.$admin->id]) !!}
                            <div class="modal-body">
                            <div class="errors" id="errors_{{$admin->id}}">

                            </div>


                                <div class="form-group">
                                    <label for="password">@lang('register.password_new')</label>
                                    <input type="password" minlength="6" maxlength="255" name="password" id="password_{{$admin->id}}" class="form-control">
                                </div> <div class="form-group">
                                    <label for="password">@lang('register.password_new_confirmation')</label>
                                    <input type="password" minlength="6" id="password_confirmation_{{$admin->id}}" maxlength="255" name="password_confirmation" class="form-control">
                                </div>
                                {!! Form::hidden('id', $admin->id) !!}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('trans.cancel') }}</button>
                                <button type="button" class="btn btn-primary" onclick="SaveAdmin('{{$admin->id}}')">{{ trans('trans.save') }}</button>
                            </div>
                            {!! Form::close() !!}
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->




            @endforeach
            </tbody>
        </table>

    </div>
@stop


@section('script')
    <!-- DataTables -->
    {!! HTML::script('/js/jquery.dataTables.min.js') !!}
    {!! HTML::script('/js/dataTables.bootstrap.min.js') !!}
    <script>
        function SaveAdmin(id){
            var password=$('#password_'+id).val();
            var password_confirmation=$('#password_confirmation_'+id).val();
            console.log(password.length);
            console.log(password_confirmation);
            if(password.length>0 && password_confirmation.length>0){
                if(password.length<6){
                    $('#password_'+id).css({'border':'1px solid red'});
                    $('#password_'+id).focus();
                    $('#errors_'+id).html('@lang("register.password_min")');
                    return;
                }else{
                    $('#errors_'+id).html('');
                    $('#password_'+id).css({'border': '1px solid #b6b6b6'});

                }
                if(password_confirmation != password){
                    $('#password_confirmation_'+id).css({'border':'1px solid red'});
                    $('#password_confirmation_'+id).focus();
                    $('#errors_'+id).html('@lang("register.password_confirmation")');
                    return;
                }else{

                    $('#errors_'+id).html('');
                    $('#password_confirmation_'+id).css({'border': '1px solid #b6b6b6'});
                }
            }else{
                if(password.length==0){
                    $('#errors_'+id).html('@lang("register.password_min")');
                }
                if(password_confirmation.length==0){
                    $('#errors_'+id).html('@lang("register.password_confirmation")');
                }
                return;
            }

            $('#form_'+id).submit();
        }

        {{--$(function () {--}}
            {{--$('#users').DataTable({--}}
                {{--"paging": true,--}}
                {{--"lengthChange": true,--}}
                {{--"searching": true,--}}
                {{--"ordering": true,--}}
                {{--"info": true,--}}
                {{--"autoWidth": false,--}}
                {{--"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],--}}
                {{--"aaSorting": [],--}}
                {{--columnDefs: [ { orderable: false, targets: [2,1] }],--}}
                {{--@if(Lang::getLocale()=='ro')--}}
                {{--"language": {--}}
                    {{--"sProcessing":   "Proceseaza...",--}}
                    {{--"sLengthMenu":   "Afiseaza _MENU_ inregistrari pe pagina",--}}
                    {{--"sZeroRecords":  "Nu am gasit nimic - ne pare rau",--}}
                    {{--"sInfo":         "Afisate de la _START_ la _END_ din _TOTAL_ inregistrari",--}}
                    {{--"sInfoEmpty":    "Afisate de la 0 la 0 din 0 inregistrari",--}}
                    {{--"sInfoFiltered": "(filtrate dintr-un total de _MAX_ inregistrari)",--}}
                    {{--"sInfoPostFix":  "",--}}
                    {{--"sSearch":       "Cauta:",--}}
                    {{--"sUrl":          "",--}}
                    {{--"oPaginate": {--}}
                        {{--"sFirst":    "Prima",--}}
                        {{--"sPrevious": "Precedenta",--}}
                        {{--"sNext":     "Urmatoarea",--}}
                        {{--"sLast":     "Ultima"--}}
                    {{--}--}}
                {{--},--}}
                {{--@elseif(Lang::getLocale()=='ru')--}}
                {{--"language": {--}}
                    {{--"processing": "Подождите...",--}}
                    {{--"search": "Поиск:",--}}
                    {{--"lengthMenu": "Показать _MENU_ записей",--}}
                    {{--"info": "Записи с _START_ до _END_ из _TOTAL_ записей",--}}
                    {{--"infoEmpty": "Записи с 0 до 0 из 0 записей",--}}
                    {{--"infoFiltered": "(отфильтровано из _MAX_ записей)",--}}
                    {{--"infoPostFix": "",--}}
                    {{--"loadingRecords": "Загрузка записей...",--}}
                    {{--"zeroRecords": "Записи отсутствуют.",--}}
                    {{--"emptyTable": "В таблице отсутствуют данные",--}}
                    {{--"paginate": {--}}
                        {{--"first": "Первая",--}}
                        {{--"previous": "Предыдущая",--}}
                        {{--"next": "Следующая",--}}
                        {{--"last": "Последняя"--}}
                    {{--},--}}
                    {{--"aria": {--}}
                        {{--"sortAscending": ": активировать для сортировки столбца по возрастанию",--}}
                        {{--"sortDescending": ": активировать для сортировки столбца по убыванию"--}}
                    {{--}--}}
                {{--},--}}
                {{--@else--}}
                {{--"language": {--}}
                    {{--"sEmptyTable":     "No data available in table",--}}
                    {{--"sInfo":           "Showing _START_ to _END_ of _TOTAL_ entries",--}}
                    {{--"sInfoEmpty":      "Showing 0 to 0 of 0 entries",--}}
                    {{--"sInfoFiltered":   "(filtered from _MAX_ total entries)",--}}
                    {{--"sInfoPostFix":    "",--}}
                    {{--"sInfoThousands":  ",",--}}
                    {{--"sLengthMenu":     "Show _MENU_ entries",--}}
                    {{--"sLoadingRecords": "Loading...",--}}
                    {{--"sProcessing":     "Processing...",--}}
                    {{--"sSearch":         "Search:",--}}
                    {{--"sZeroRecords":    "No matching records found",--}}
                    {{--"oPaginate": {--}}
                        {{--"sFirst":    "First",--}}
                        {{--"sLast":     "Last",--}}
                        {{--"sNext":     "Next",--}}
                        {{--"sPrevious": "Previous"--}}
                    {{--},--}}
                    {{--"oAria": {--}}
                        {{--"sSortAscending":  ": activate to sort column ascending",--}}
                        {{--"sSortDescending": ": activate to sort column descending"--}}
                    {{--}--}}

                {{--},--}}
                {{--@endif--}}
            {{--});--}}
        {{--});--}}
    </script>
@stop

