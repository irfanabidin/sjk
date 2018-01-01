<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laravel CRUD Generator</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/styles.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	
	<style>
		.image-bg-fluid-height,
		.image-bg-fixed-height {
			text-align: center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			background-size: cover;
			-o-background-size: cover;
		}

		.image-bg-fluid-height {
			background: linear-gradient(141deg, #afd 0%, #1fc8db 51%, #2cb5f8 75%);
			text-align: center;
			padding: 20px 0;
			color: #fff;
		}

		.img-center {
			margin: 0 auto;
		}

		footer {
			margin: 60px 0;
		}
		
		.container{
			padding-top: 20px;
			padding-bottom: 200px;
		}

		@media(max-width:768px) {
			section {
				padding-top: 25px;
				padding-bottom: 25px;
			}

			.section-heading {
				font-size: 2em;
			}
		}	
	</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


    <!-- Full Width Image Header with Logo -->
    <!-- Image backgrounds are set within the full-width-pics.css file. -->
    <header class="image-bg-fluid-height">
        <h2>Laravel CRUD Generator</h2>
    </header>


    <!-- Content Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

				
				
				
<form action="" class="form-inline">
  <h3>Select Table</h3>
  <div class="form-group">
    <label">Table:</label>
	<select name="table" class="form-control">
	@foreach($tables as $t)
		<option value="{{ $t }}" {{ $table == $t ? 'selected' : '' }}>{{ $t }}</option>
	@endforeach
	</select>
  </div>
  <button type="submit" class="btn btn-default">Select</button>
</form>				

<br />


@if(!empty($table))
<form action="">
<input type="hidden" name="action" value="generate">
<input type="hidden" name="table" value="{{ $table }}">
<h3>Configure Column</h3>
<div class="row">
<div class="col-sm-6">
	<div class="form-horizontal">
	  <div class="form-group">
		<label class="col-sm-4">Title</label>
		<div class="col-sm-8">
		<input type="text" name="title" class="form-control input-sm" value="{{ $title }}" placeholder="Title">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4">Model Name</label>
		<div class="col-sm-8">
		<input type="text" name="model" class="form-control input-sm" value="{{ $model }}" placeholder="Model Name">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4">Instance Name</label>
		<div class="col-sm-8">
		<input type="text" name="instance" class="form-control input-sm" value="{{ $instance }}" placeholder="Instance Name">
		</div>
	  </div>
	</div>
</div>
<div class="col-sm-6">
	<div class="form-horizontal">
	  <div class="form-group">
		<label class="col-sm-4">Table Key</label>
		<div class="col-sm-8">
			<select name="table_key" class="form-control">
			@foreach($columns as $column)
				<option value="{{ $column->field }}">{{ $column->field }}</option>
			@endforeach
			</select>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4">Order By</label>
		<div class="col-sm-8">
			<select name="order_column" class="form-control">
			@foreach($columns as $column)
				<option value="{{ $column->field }}">{{ $column->field }}</option>
			@endforeach
			</select>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4">Order Direction</label>
		<div class="col-sm-8">
			<label class="radio-inline">
			  <input type="radio" name="order_direction" value="asc" checked="checked"> ASCENDING
			</label>
			<label class="radio-inline">
			  <input type="radio" name="order_direction" value="desc"> DESCENDING
			</label>
		</div>
	  </div>
	</div>
</div>
</div>
<br />

<table class="table table-condensed">
	<tr>
		<th>Hide</th>
		<th>Field</th>
		<th>Key</th>
		<th>Type</th>
		<th>Length</th>
		<th>Label</th>
		<th>Default</th>
		<th>Guarded</th>
		<th>Required</th>
		<th>Searching</th>
		<th></th>
	</tr>	
	@php
		$i = 0;
	@endphp
	@foreach($columns as $column)
	<tr>
		<td><input type="checkbox" name="hide[{{ $i }}]" value="1"></td>
		<td>{{ $column->field }}<input type="hidden" name="field[]" value="{{ $column->field }}"/></td>
		<td>{{ $column->key }}<input type="hidden" name="key[]" value="{{ $column->key }}"/></td>
		<td>
			<select name="type[]" class="form-control">
				<option value="{{ 'text' }}" {{ $column->type == 'text' ? 'selected' : '' }}>text</option>
				<option value="{{ 'number' }}" {{ $column->type == 'number' ? 'selected' : '' }}>number</option>
				<option value="{{ 'date' }}" {{ $column->type == 'date' ? 'selected' : '' }}>date</option>
				<option value="{{ 'time' }}" {{ $column->type == 'time' ? 'selected' : '' }}>time</option>
				<option value="{{ 'datetime-local' }}" {{ $column->type == 'datetime-local' ? 'selected' : '' }}>datetime-local</option>
			</select>		
		</td>
		<td><input type="number" name="length[]" class="form-control input-sm" value="{{ $column->length }}" placeholder="Length"></td>
		<td><input type="text" name="label[]" class="form-control input-sm" value="{{ $column->label }}" placeholder="Label"></td>
		<td><input type="text" name="default[]" class="form-control input-sm" value="{{ $column->default }}" placeholder="Default"></td>
		<td><input type="checkbox" name="guarded[{{ $i }}]" class="cb" value="1" {{ $column->guarded ? 'checked' : '' }}></td>
		<td><input type="checkbox" name="null[{{ $i }}]" value="1" {{ $column->null ? 'checked' : '' }}></td>
		<td><input type="checkbox" name="search[{{ $i }}]" value="1" {{ $column->search ? 'checked' : '' }}></td>
		<td></td>
	</tr>	
	@php
		$i++;
	@endphp
	@endforeach
</table>	

<button type="submit" class="btn btn-primary btn-lg">GENERATE!</button>
@endif
</form>	
<br/>	
@if($success == 1)		
<div class="alert alert-success" role="success">
  <h4 id="success">Done!</h4>
  Please follow this instruction:
  <figure class="highlight">
    <pre>
Move the generated Model, View and Controller files to your project:
public\crudgen\output

Add new resource route:
Route::resources('{{ $instance }}', '{{ $model }}Controller');
    </pre>
  </figure>
</div>
@endif
				
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>


<script>

</script>

</body>

</html>


