@extends('layouts.app')

@section('title', '@TITLE@')

@section('css')
<link href="/css/datatables.css" rel="stylesheet">
<link href="/css/form.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('title')</div>

                <div class="panel-body">

    <div class="tableview">        
    <table id="@INSTANCE@-dataview" class="table table-condensed table-striped" cellspacing="0">
        <thead>
            <tr>
@COLUMNS_HEADER@<th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
@COLUMNS_HEADER@<th>Action</th></tr>
        </tfoot>
    </table>
</div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL ADD/EDIT -->
<div class="modal fade" id="@INSTANCE@-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    </div>
  </div>
</div>

@endsection

@section('actionbutton')
<form method="post" action="{{ route('@INSTANCE@.destroy', '_id') }}" accept-charset="UTF-8">
{{ csrf_field() }}{{ method_field('DELETE') }}
<div class="btn-group btn-group-xs">
    <a class="btn btn-info" href="{{ route('@INSTANCE@.show', '_id') }}" data-remote="false" data-toggle="modal" data-target="#@INSTANCE@-modal"><span><i class="fa fa-eye fa-fw"></i></span></a>
    <a class="btn btn-warning" href="{{ route('@INSTANCE@.edit', '_id') }}" data-remote="false" data-toggle="modal" data-target="#@INSTANCE@-modal"><span><i class="fa fa-pencil fa-fw"></i></span></a>
    <button type="submit" class="btn btn-danger confirm-delete"><span><i class="fa fa-remove fa-fw"></i></span></button>
</div>
</form>
@endsection

@section('scripts')
<script src="/js/datatables.js" type="text/javascript"></script>
<script src="/js/form.js" type="text/javascript"></script>
<script>
var @INSTANCE@Table;
$(document).ready(function(){

        @INSTANCE@Table = $('#@INSTANCE@-dataview').DataTable( {
        processing: true,
        serverSide: true,
        language: {
            processing: '<i class="fa fa-refresh  fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span>'
        },
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10', '25', '50', '100', 'All']
        ],
        responsive: true,
        dom: 'Bfrtipr',
        buttons: [ 
            {
                text: '<i class="fa fa-plus fa-fw"></i>',
                className: '@INSTANCE@-btn-add btn-success'
            },  
            {
                text: '<i class="fa fa-refresh fa-fw"></i>',
                action: function ( e, dt, node, config ) {
                    dt.ajax.reload();
                }
            },
            ['pageLength'],
            {
                extend:'copyHtml5',
                text: '<i class="fa fa-copy fa-fw"></i>'
            },
            {
                extend:'csvHtml5',
                text: '<i class="fa fa-file-code-o fa-fw"></i>'
            },
            {
                extend:'excelHtml5',
                text: '<i class="fa fa-file-excel-o fa-fw"></i>'
            },
            {
                extend:'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o fa-fw"></i>'
            },
            {
                extend:'print',
                text: '<i class="fa fa-print fa-fw"></i>'
            }, 
        ],
        "ajax": '{{ action("@MODEL@Controller@index", ["json" => "true"]) }}',     
        "columns": [@COLUMNS_DATATABLES@
            { 
                "data": "@TABLE_KEY@",
                sortable: false,
                searching: false,
                "render" : function(data, type, row, meta){
                    return (`@yield('actionbutton')`).replace(new RegExp('_id', 'g'), data);
                }
            }
        ],
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
    } );

    $('.@INSTANCE@-btn-add')
        .attr('href', "{{ route('@INSTANCE@.create') }}")
        .attr('data-target', '#@INSTANCE@-modal')
        .attr('data-remote', 'false')
        .attr('data-toggle', 'modal');

    $('#@INSTANCE@-dataview tbody').on('click', 'button', function(e){
        var form = $(this).parents('form');
        swal({
            title: "Apakah anda yakin akan menghapus data ini?",
            text: "Data akan terhapus dalam database sistem",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
            //closeOnConfirm: true,
        }, function(isConfirm){
            if (isConfirm){
                $.ajax({
                    url: form.attr('action'),
                    type: 'DELETE', 
                    data: form.serialize(),
                    success: function(data){
                        if(data == 'success'){
                            swal({
                                title:"Deleted!",
                                text:'Data telah dihapus', 
                                type:"success",
                                timer: 1500,
                                showCancelButton: false,
                                showConfirmButton  : false
                            });
                            @INSTANCE@Table.ajax.reload();
                        }else{
                            swal('Error!',data,'error')
                        }
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        swal('Error!',msg,'error');
                    },
                });
            }
        });    
        e.preventDefault();
    });

    //MODAL
    $("#@INSTANCE@-modal").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $(this).find(".modal-content").html(
            `<div style="min-height: 500px;">
                <center style="padding-top: 200px;">
                    <i class="fa fa-refresh  fa-spin fa-5x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </center>
            </div>`
        );
        $(this).find(".modal-content").load(link.attr("href"));
    });

    $('#@INSTANCE@-modal').on('hidden.bs.modal', function () {
        //@INSTANCE@Table.ajax.reload();
    });    

});




</script>



@endsection


