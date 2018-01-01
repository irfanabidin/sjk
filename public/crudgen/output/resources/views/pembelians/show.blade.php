<div class="modal-header">
    <button type="button" id="pembelians-form-close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Data Detail</h4>
</div>
<div class="modal-body">
    <dl class="dl-horizontal">
        <dt>Nama</dt>
        <dd>{{ $pembelians->nama }}</dd>
        <dt>Tgl</dt>
        <dd>{{ $pembelians->tgl }}</dd>
        <dt>Stok</dt>
        <dd>{{ $pembelians->stok }}</dd>
        <dt>Hrgpokok</dt>
        <dd>{{ $pembelians->hrgpokok }}</dd>
        <dt>Pid</dt>
        <dd>{{ $pembelians->pid }}</dd>

    </dl>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove fa-fw"></i> Close</button>
</div>