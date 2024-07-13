@extends('layouts.adminlte-sidebar')

@section('page-title')
    Registrasi Perangkat
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registrasi Perangkat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.devices') }}">Perangkat</a>
                    </li>
                    <li class="breadcrumb-item active">Registrasi</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content-main')
    <div class="container-fluid">
        <div class="col-12 col-lg-11 col-xl-10 d-flex flex-column p-2">
            <div class="card bg-gray-light"> 
                <div class="card-header">
                    <h3 class="card-title">
                        Registrasi
                    </h3>
                </div>
                <div class="card-body shadow">
                    <form action="{{route('medis.deviceCreate')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="deviceSerial">Nomor Seri</label>
                            <input type="text" class="form-control @error('deviceSerial') is-invalid @enderror" id="deviceSerial" value="@if (old('deviceSerial')){{old('deviceSerial')}}@endif" name="deviceSerial" placeholder="Masukkan Nomor Seri Alat">
                            @error('deviceSerial')
                                <div id="inpNameFeedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            <small class="form-text text-muted">Nomor Seri Alat tertera pada alat</small>
                        </div> 
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div> 
    </div><!-- /.container-fluid -->
@endsection

@section('styles') 
@endsection

@section('scripts') 
<script>  
</script>
@endsection
