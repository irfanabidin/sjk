@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><font size="4" color="black">Edit pembelian</font></div>
                <div class="panel-body">
                    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="post">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('nama') ? 'has-error' : '' }}">
                                    <label for="nama" class="col-sm-4 form-control-label">Nama <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nama" class="form-control" placeholder="Nama pembelian" value="{{ $pembelian->nama}}" required="required">
                                        @if ($errors->has('nama'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('tgl') ? 'has-error' : '' }}">
                                    <label for="nama" class="col-sm-4 form-control-label">tgl <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">
     
                            <input type="date" name="tgl" class="form-control" placeholder="tgl" value="{{ $pembelian->tgl }}" required="required">

                                        @if ($errors->has('tgl'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tgl') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('stok') ? 'has-error' : '' }}">
                                    <label for="nama" class="col-sm-4 form-control-label">Stok <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="stok" class="form-control" placeholder="Stok" value="{{ $pembelian->stok }}" required="required">
                                        @if ($errors->has('stok'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('stok') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('password-repeat') ? 'has-error' : '' }}">
                                    <label for="nama" class="col-sm-4 form-control-label">Harga Pokok <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="hrgpokok" class="form-control" placeholder="Harga Pokok" value="{{ $pembelian->hrgpokok }}" required="required">
                                        @if ($errors->has('password-repeat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('hrgpokok') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="alert alert-info" role="alert">
                                    <b>Catatan</b><br>
                                    <font size="3" color="black">
                                    Tanda bintang merah (<span style="color:red;font-weight:bold">*</span>) menandakan kolom tersebut wajib diisi.
                                    </font>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="submit" class="btn btn-primary" value="Simpan">
                                <a class="btn btn-primary" href="{{ route('pembelian.index') }}">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
@endpush
