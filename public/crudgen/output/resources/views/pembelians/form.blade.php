<link href="/css/form.css" rel="stylesheet">

<form id="pembelians-form" class="form-horizontal" action="{{ $option['url'] }}" method="post">
  {{ csrf_field() }}{{ method_field($option['method']) }}

  <div class="modal-header">
    <button type="button" id="pembelians-form-close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{{ $option['title'] }}</h4>
  </div>
  <div class="modal-body">
 
    <div class="form-group">
      <label class="col-md-4 control-label">Nama</label>  
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
          <input name="nama" value="{{ $pembelians->nama }}" type="text" maxlength="30" class="form-control">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Tgl</label>  
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
          <input name="tgl" value="{{ $pembelians->tgl }}" type="date" class="form-control">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Stok</label>  
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
          <input name="stok" value="{{ $pembelians->stok }}" type="number" class="form-control">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Hrgpokok</label>  
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
          <input name="hrgpokok" value="{{ $pembelians->hrgpokok }}" type="text" class="form-control">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Pid</label>  
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
          <input name="pid" value="{{ $pembelians->pid }}" type="number" class="form-control">
        </div>
      </div>
    </div>


  </div>
  <div class="modal-footer">
    <i id="pembelians-form-loader" class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
    <button type="submit" id="pembelians-form-submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> {{ $option['submit_text'] }}</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove fa-fw"></i> Close</button>
  </div>
</form>

<script src="/js/form.js" type="text/javascript"></script>
<script>
$('#pembelians-form-loader').hide();

$('document').ready(function(){

    $('#pembelians-form-submit').click(function(e){      
        $('#pembelians-form-loader').show();
        var form = $('#pembelians-form');
        $.ajax({
            url: form.attr('action'),
            type: "{{ $option['method'] }}",
            data: form.serialize(),
            success: function(data){
                if(data == 'success'){
                    swal({
                        title:"Tersimpan",
                        text:'Data telah tersimpan', 
                        type:"success",
                        timer: 1500,
                        showCancelButton: false,
                        showConfirmButton  : false
                    });                    
                    $('#pembelians-form-loader').hide();
                    pembeliansTable.ajax.reload();
                }else{
                    swal('Error!',data,'error');
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
        e.preventDefault();    
    });

});
</script>