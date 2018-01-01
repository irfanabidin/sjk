<div class="modal-header">
    <button type="button" id="example-form-close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Data Detail</h4>
</div>
<div class="modal-body">
    <dl class="dl-horizontal">
        <dt>Col1</dt>
        <dd>{{ $example->col1 }}</dd>
        <dt>Col2</dt>
        <dd>{{ $example->col2 }}</dd>
        <dt>Col3</dt>
        <dd>{{ $example->col3 }}</dd>
        <dt>Col4</dt>
        <dd>{{ $example->col4 }}</dd>
    </dl>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove fa-fw"></i> Close</button>
</div>