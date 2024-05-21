@extends('layouts.adminlte-sidebar')

@section('page-title')
    Detail Pasien
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Pasien</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Pasien</li>
                </ol>
            </div><!-- /.col --> 
        </div><!-- /.row -->
        
    </div><!-- /.container-fluid -->
@endsection

@section('content-main')

    <div class="container-fluid">
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <form action="{{route('medis.pasienUpdate', $pasien)}}" method="POST" novalidate>
                @csrf
                <div class="card bg-gray-light">
                    <div class="card-header">
                        <div class="card-title"> 
                            <span class="h6">Data Pasien</span>
                        </div>
                        <div class="card-tools">
                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="fas fa-save"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-8">
                                <table class="table table-borderless ">
                                    <tr>
                                        <th><label for="inpName">Nama</label></th>
                                        <td>
                                            <input class="form-control @error('inpName') is-invalid @enderror" type="text" name="inpName" id="inpName" 
                                            value="@if (old('inpName')){{old('inpName')}}@else{{$pasien->user->name}}@endif">
                                            @error('inpName')
                                                <div id="inpNameFeedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th><label for="inpGender">Jenis Kelamin</label></th>
                                        <td>
                                            <select class="form-control @error('inpGender') is-invalid @enderror" name="inpGender" id="inpGender">
                                                <option selected value="{{$pasien->gender?1:2}}">{{$pasien->gender()}}</option>
                                                <option value="1">Laki-laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                            @error('inpGender')
                                                <div id="inpGenderFeedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="inpBorn">Tanggal Lahir</label></th>
                                        <td> 
                                            <div class="input-group date" id="born-date" data-target-input="nearest">
                                                <input name="inpBorn" id="born-date-field"  type="text" class="form-control datetimepicker-input @error('inpBorn') is-invalid @enderror" data-target="#born-date"
                                                value="@if (old('inpBorn')){{old('inpBorn')}}@else{{$pasien->born()}}@endif"/>
                                                <div class="input-group-append" data-target="#born-date" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('inpBorn')
                                                    <div id="inpBornFeedback" class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="inpWeight">Berat Badan</label></th>
                                        <td>
                                            <input class="form-control @error('inpWeight') is-invalid @enderror" type="number" name="inpWeight" id="inpWeight" 
                                            value="@if (old('inpWeight')){{old('inpWeight')}}@else{{$pasien->weight}}@endif">
                                            @error('inpWeight')
                                                <div id="inpWeightFeedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="inpHeight">Tinggi Badan</label></th>
                                        <td> 
                                            <input class="form-control @error('inpHeight') is-invalid @enderror" type="number" name="inpHeight" id="inpHeight"
                                            value="@if (old('inpHeight')){{old('inpHeight')}}@else{{$pasien->height}}@endif"> 
                                            @error('inpHeight')
                                                <div id="inpHeightFeedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Riwayat Penyakit</th>
                                        <td>
                                            <!-- TODO: RIWAYAT PENYAKIT -->
                                        </td>
                                    </tr>
                                </table> 
                            </div>
                            <div class="col-4">
                                <img class="img img-fluid" src="{{$pasien->user->getAvatar()}}" alt="">
                            </div>
                            <hr> 
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <div class="card bg-gray-light">
                <div class="card-header">
                    <div class="card-title"> 
                        <span class="h6">Riwayat Terapi</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- TODO: RIWAYAT -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('styles') 
@endsection

@section('scripts') 
    <script>
        //Date picker
        $('#born-date').datetimepicker({
            format: 'DD/MM/YYYY',
            viewDate: '{{$pasien->born}}'
        });

        $('#born-date-field').val('{{$pasien->born()}}')
    </script>
    
@endsection
