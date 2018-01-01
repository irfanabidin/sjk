@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')

<div class="container" id="app">
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('info_message'))
            <div class="alert alert-info"><p>{{ Session::get('info_message') }}</p></div>
            @endif
            @if (Session::has('warning_message'))
            <div class="alert alert-warning"><p>{{ Session::get('warning_message') }}</p></div>
            @endif
            @if (Session::has('success_message'))
            <div class="alert alert-success"><p>{{ Session::get('success_message') }}</p></div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><font size="4" color="black">Data Tagihan</font></div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-3" style="border">
                                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                    <a href="{{ route('tagihan.create')}}" class="btn btn-success"><i class="fa fa-plus fa-fw"></i></a>
                                </div>
                            </div>
                            <div class="col-xs-3" align="center">
                                <form method="get" class="input-group input-group-sm">
                                    <input name="page" type="hidden" value="{{ $tagihan->currentPage()}}" />
                                    <input name="q" type="text" class="form-control" placeholder="Cari" value="{{ $request->input('q')}}" />
                                    <div class="input-group-btn">
                                        <input type="submit" class="btn btn-success" value="Cari">
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-4">
                                <form method="get" class="input-group input-group-sm">
                                    <span class="input-group-btn">
                                        <a class="btn btn-default" href="{{ str_replace('/?', '?', $tagihan->url(1))}}"
                                           @if($tagihan->currentPage() == 1) disabled @endif>&laquo;</a>
                                        <a class="btn btn-default"
                                           href="{{ str_replace('/?', '?', $tagihan->previousPageUrl())}}"
                                           @if($tagihan->currentPage() == 1) disabled @endif><</a>
                                    </span>
                                    <span class="input-group-addon" id="basic-addon2">page</span>
                                    <input name="page" type="number" style="border-left: 0; border-right: 0;" value="{{ $tagihan->currentPage()}}" min="1" max="{{ $tagihan->lastPage()}}" class="form-control crud-page-number">
                                    <span class="input-group-addon">of {{ $tagihan->lastPage()}}</span>
                                    <span class="input-group-btn">
                                        <a class="btn btn-default" href="{{ str_replace('/?', '?', $tagihan->nextPageUrl())}}{{ (count($request->input('q')) > 0) ? ('&q='.$request->input('q')) : ('')}}"
                                           @if($tagihan->currentPage() == $tagihan->lastPage()) disabled @endif>></a>
                                        <a class="btn btn-default" href="{{ str_replace('/?', '?', $tagihan->url($tagihan->lastPage()))}}{{ (count($request->input('q')) > 0) ? ('&q='.$request->input('q')) : ('')}}"
                                           @if($tagihan->currentPage() == $tagihan->lastPage()) disabled @endif>&raquo;</a>
                                    </span>
                                </form>
                            </div>
                            <div class="col-xs-2">
                                <div class="input-group input-group-sm">
                                    Total: {{ $tagihan->total()}} data
                                </div>
                            </div>
                        </div><!-- /.row -->
                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                @if ( !$tagihan->count() )
                                <div class="alert alert-warning">
                                    <p>Tidak ada data</p>
                                </div>
                                @else
                                <table class="table table-striped table-condensed table-hover table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>No Tagihan</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Tagihan</th>
                                        <th>Pengeluaran</th>
                                        <th>Admin</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php
                                        if ($tagihan->currentPage() == 1) {
                                            $no = 1;
                                        } else {
                                            $no = $tagihan->perPage() * ($tagihan->currentPage() - 1) + 1;
                                        }
                                    ?>
                                    @foreach($tagihan as $tagihan)
                                        <tr>
                                            <td><font size="3" color="black">{{ $no++ }}</font></td>
                                            <td><font size="3" color="black">{{ $tagihan->notag }}</font></td>
                                            <td><font size="3" color="black">{{ $tagihan->tgl }}</font></td>
                                            <td><font size="3" color="black">{{ $tagihan->jenistag }}</font></td>
                                            <td><font size="3" color="black">Rp.{{ number_format($tagihan->pengeluaran, 2)}}</td>
                                            <td>{{ $tagihan->pid }}</td></td>
                                            <td align="center">
                                                <div class="btn-group btn-group-xs">
                                                   <!-- <a class="btn btn-default" href="{{ route('tagihan.edit', $tagihan->id)}}"><i class="fa fa-pencil fa-fw"></i></a> -->
                                                        <confirm id="{{ $tagihan->id }}"></confirm>
                                                </div>
                                                <form method="POST" action="{{ route('tagihan.destroy', $tagihan->id)}}" id="form{{ $tagihan->id }}">
                                                    {{ csrf_field() }}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                @endif
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group input-group-sm">
                                    <font size="3" color="black"><b>
                                    Total Tagihan &nbsp; &nbsp;:&nbsp;Rp.{{ number_format($jmltag, 2)}}
                                    </b>
                                    </font> 
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection

@endsection
