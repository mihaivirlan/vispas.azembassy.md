@extends('admin.adminLayout')

@section('title')
    @lang('trans.achivements')
@stop

@section('style')
    {!! HTML::style('/css/dataTables.bootstrap.css') !!}

    <style>
        table tr td:nth-child(3){width: 100px;}
        table tr td:nth-child(4){width: 100px;}
    </style>
@stop
@section('content')

    <h1>@lang('trans.achivements')</h1>


    <div class="box">
        <div class="box-body">
            <table id="news" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('trans.name')</th>
                    <th>@lang('trans.value')</th>
                    <th class="text-center" > @lang('trans.action')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->$name_user}}</td>
                        <td>{{  $item->value }}</td>
                        <td class="text-center">
                            <a href="{{URL::route('admin/achivement',$item->id)}}" class="edit-pencil btn btn-xs btn-primary" title="{{ trans('trans.edit') }}">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>



                        </td>
                        <td class="status">@if( $item->status ) <span class="active" style="color: transparent;margin: 0 auto;">1</span> @else <span class="no-active" style="color: transparent;margin: 0 auto;">0</span>@endif </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->



@stop

@section('script')
    <!-- DataTables -->
    {!! HTML::script('/js/jquery.dataTables.min.js') !!}
    {!! HTML::script('/js/dataTables.bootstrap.min.js') !!}
    <script>
        $(function () {
            $('#news').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "iDisplayLength": 25,
                "aaSorting": [],
                columnDefs: [ { orderable: false, targets: [2,1] }],
                @if(Lang::getLocale()=='ro')
                "language": {
                    "sProcessing":   "Proceseaza...",
                    "sLengthMenu":   "Afiseaza _MENU_ inregistrari pe pagina",
                    "sZeroRecords":  "Nu am gasit nimic - ne pare rau",
                    "sInfo":         "Afisate de la _START_ la _END_ din _TOTAL_ inregistrari",
                    "sInfoEmpty":    "Afisate de la 0 la 0 din 0 inregistrari",
                    "sInfoFiltered": "(filtrate dintr-un total de _MAX_ inregistrari)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Cauta:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Prima",
                        "sPrevious": "Precedenta",
                        "sNext":     "Urmatoarea",
                        "sLast":     "Ultima"
                    }
                },
                @elseif(Lang::getLocale()=='ru')
                "language": {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    }
                },
                @else
                "language": {
                    "sEmptyTable":     "No data available in table",
                    "sInfo":           "Showing _START_ to _END_ of _TOTAL_ entries",
                    "sInfoEmpty":      "Showing 0 to 0 of 0 entries",
                    "sInfoFiltered":   "(filtered from _MAX_ total entries)",
                    "sInfoPostFix":    "",
                    "sInfoThousands":  ",",
                    "sLengthMenu":     "Show _MENU_ entries",
                    "sLoadingRecords": "Loading...",
                    "sProcessing":     "Processing...",
                    "sSearch":         "Search:",
                    "sZeroRecords":    "No matching records found",
                    "oPaginate": {
                        "sFirst":    "First",
                        "sLast":     "Last",
                        "sNext":     "Next",
                        "sPrevious": "Previous"
                    },
                    "oAria": {
                        "sSortAscending":  ": activate to sort column ascending",
                        "sSortDescending": ": activate to sort column descending"
                    }

                },
                @endif
            });
        });
    </script>
@stop
