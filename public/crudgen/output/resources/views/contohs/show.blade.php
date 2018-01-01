<div class="modal-header">
    <button type="button" id="contohs-form-close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Data Detail</h4>
</div>
<div class="modal-body">
    <dl class="dl-horizontal">
        <dt>Id</dt>
        <dd>{{ $contohs->id }}</dd>
        <dt>Name</dt>
        <dd>{{ $contohs->name }}</dd>
        <dt>Ini</dt>
        <dd>{{ $contohs->ini }}</dd>

    </dl>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove fa-fw"></i> Close</button>
</div>