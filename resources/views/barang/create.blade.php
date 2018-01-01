@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><font size="4" color="black">Tambah Data Penjualan</font></div>
                <div class="panel-body">
                    <form action="{{ route('barang.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('nama') ? 'has-error' : '' }}">
                                    <label for="nama" class="col-sm-4 form-control-label">Nama <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">

                                <select name="nama" class="form-control" placeholder="nama" required="required">
                                        @foreach($pembelian as $pembelian)

                                            <option value="{{ $pembelian->nama }}">
                                                {{ $pembelian->nama }}
                                            </option>

                                        @endforeach

                                    </select>

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
     
                            <input type="date" name="tgl" class="form-control" placeholder="tgl" value="{{ old('tgl') }}" required="required">

                                        @if ($errors->has('email'))
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
                                <div class="form-group row {{ $errors->has('brterjual') ? 'has-error' : '' }}">
                                    <label for="nama" class="col-sm-4 form-control-label">Barang Terjual <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="brterjual" class="form-control" placeholder="barang terjual" value="{{ old('brterjual') }}" required="required">
                                        @if ($errors->has('brterjual'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('brterjual') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('hrgjual') ? 'has-error' : '' }}">
                                    <label for="nama" class="col-sm-4 form-control-label">Harga Jual <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="hrgjual" class="form-control" placeholder="Harga Jual" value="{{ old('hrgjual') }}" required="required">
                                        @if ($errors->has('password-repeat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('hrgjual') }}</strong>
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
                                        <input type="number" name="hrgpokok" class="form-control" placeholder="Harga Pokok" value="{{ old('hrgpokok') }}" required="required">
                                        @if ($errors->has('password-repeat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('hrgpokok') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> <div class="row">
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
                                <a class="btn btn-primary" href="{{ route('barang.index') }}">Kembali</a>
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
