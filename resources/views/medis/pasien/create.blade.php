@extends('layouts.adminlte-sidebar')

@section('page-title')
    Tambah Pasien
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Pasien</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Pasien</li>
                </ol>
            </div><!-- /.col --> 
        </div><!-- /.row -->
        
    </div><!-- /.container-fluid -->
@endsection

@section('content-main')

    <div class="container-fluid">
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <form action="{{route('medis.pasien.store')}}" method="POST" novalidate>
                @csrf
                <div class="card bg-gray-light">
                    <div class="card-header">
                        <div class="card-title"> 
                            <span class="h6">Data Pasien</span>
                        </div>
                        <div class="card-tools">
                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="fas fa-save"></i>
                                Tambahkan pasien
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
                                            value="@if (old('inpName')){{old('inpName')}}@endif">
                                            @error('inpName')
                                                <div id="inpNameFeedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th><label for="inpName">Email</label></th>
                                        <td>
                                            <input class="form-control @error('inpEmail') is-invalid @enderror" type="text" name="inpEmail" id="inpEmail" 
                                            value="@if (old('inpEmail')){{old('inpEmail')}}@endif">
                                            @error('inpEmail')
                                                <div id="inpEmailFeedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th><label for="inpGender">Jenis Kelamin</label></th>
                                        <td>
                                            <select class="form-control @error('inpGender') is-invalid @enderror" name="inpGender" id="inpGender"> 
                                                <option value="" @if (!old('inpGender')) selected @endif>Jenis kelamin</option>  
                                                <option value="1" @if (old('inpGender')==1) selected @endif>Laki-laki</option>
                                                <option value="2" @if (old('inpGender')==2) selected @endif>Perempuan</option>
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
                                                value="@if (old('inpBorn')){{old('inpBorn')}}@endif"/>
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
                                            value="@if (old('inpWeight')){{old('inpWeight')}}@endif">
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
                                            value="@if (old('inpHeight')){{old('inpHeight')}}@endif"> 
                                            @error('inpHeight')
                                                <div id="inpHeightFeedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="inpIllnessHistory">
                                                Riwayat Penyakit
                                            </label>
                                        </th>
                                        <td>
                                            <textarea 
                                                class="form-control @error('inpIllnessHistory') is-invalid @enderror"
                                                name="inpIllnessHistory" id="inpIllnessHistory" cols="10" rows="5">@if (old('inpIllnessHistory')){{old('inpIllnessHistory')}}@endif</textarea>
                                            @error('inpIllnessHistory')
                                                <div id="inpIllnessHistoryFeedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>
                                </table> 
                            </div>
                            <div class="col-4">
                                {{-- <img class="img img-fluid" src="{{$pasien->user->getAvatar()}}" alt=""> --}}
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
        });
 
    </script>
    
@endsection
