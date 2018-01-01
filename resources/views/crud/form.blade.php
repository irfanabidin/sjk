<link href="/css/form.css" rel="stylesheet">

<form id="example-form" class="form-horizontal" action="{{ $option['url'] }}" method="post">
  {{ csrf_field() }}{{ method_field($option['method']) }}

  <div class="modal-header">
    <button type="button" id="example-form-close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{{ $option['title'] }}</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label class="col-md-4 control-label">Col 1</label>  
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
          <input  name="col1" type="text" step="0.01" value="{{ $example->col1 }}" maxlength="10" required placeholder="Col 1" class="form-control">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Col 2</label>  
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
          <input  name="col2" type="text" value="{{ $example->col2 }}" maxlength="10" required placeholder="Col 2" class="form-control">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Col 3</label>  
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input  name="col3" type="date" value="{{ $example->col3 }}" required placeholder="Col 3" class="form-control">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Col 4</label>  
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input  name="col4" type="datetime-local" value="{{ empty($example->col4) ? '' : date('Y-m-d\TH:i:s', strtotime($example->col4)) }}" required class="form-control">
        </div>
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <i id="example-form-loader" class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
    <button type="submit" id="example-form-submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> {{ $option['submit_text'] }}</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove fa-fw"></i> Close</button>
  </div>
</form>

<script src="/js/form.js" type="text/javascript"></script>
<script>
$('#example-form-loader').hide();

$('document').ready(function(){

    $('#example-form-submit').click(function(e){      
        $('#example-form-loader').show();
        var form = $('#example-form');
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
                    $('#example-form-loader').hide();
                    exampleTable.ajax.reload();
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