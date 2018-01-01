@extends('layouts.app')

@section('content')

{!! Charts::styles() !!}
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><font size="4" color="black">Dashboard</font></div>

                  <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                  <div class="app">
                    <center>
                      {!! $chart->html() !!}
                    </center>
                  </div>
                <!-- End Of Main Application -->
                    {!! Charts::scripts() !!}
                    {!! $chart->script() !!}
                  <div class="container">
                    <font size="3" color="black"> 
                    <b> Total Laba &nbsp; &nbsp;:&nbsp; Rp.{{number_format($jml, 2)}} <br/>
                      Laba Bersih &nbsp;:&nbsp;Rp.{{ number_format($lababersih, 2)}} 
                    </b>
                  </div>
                  </font>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
