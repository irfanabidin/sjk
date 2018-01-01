@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><font size="4" color="black">Tambah Data Tagihan</font></div>
                <div class="panel-body">
                    <form action="{{ route('tagihan.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('notag') ? 'has-error' : '' }}">
                                    <label for="notag" class="col-sm-4 form-control-label">No Tagihan <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="notag" class="form-control" placeholder="no tagihan" value="{{ old('notag') }}" required="required">
                                        @if ($errors->has('notag'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('notag') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('tgl') ? 'has-error' : '' }}">
                                    <label for="notag" class="col-sm-4 form-control-label">tanggal <span style="color:red;font-weight:bold;">*</span></label>
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
                                <div class="form-group row {{ $errors->has('jenistag') ? 'has-error' : '' }}">
                                    <label for="notag" class="col-sm-4 form-control-label">Nama Tagihan <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="jenistag" class="form-control" placeholder="Nama Tagihan" value="{{ old('jenistag') }}" required="required">
                                        @if ($errors->has('jenistag'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenistag') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('pengeluaran') ? 'has-error' : '' }}">
                                    <label for="notag" class="col-sm-4 form-control-label">Besar Pengeluaran <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="pengeluaran" class="form-control" placeholder="Pengeluaran" value="{{ old('pengeluaran') }}" required="required">
                                        @if ($errors->has('pengeluaran'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pengeluaran') }}</strong>
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
                                <a class="btn btn-primary" href="{{ route('tagihan.index') }}">Kembali</a>
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
