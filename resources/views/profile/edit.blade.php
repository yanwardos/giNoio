@extends('layouts.adminlte-sidebar')

@section('page-title')
    Perbarui profil
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Perbarui profil</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('myProfile') }}">Profil saya</a>
                    </li>
                    <li class="breadcrumb-item active">Perbarui</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
@endsection

@section('content-main')

    <div class="container-fluid">
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <form action="{{ route('myProfile.update') }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="card bg-gray-light">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="h6">Data Profil</span>
                        </div>
                        <div class="card-tools">
                            <a href="{{route('profile.password.edit')}}" class="btn btn-danger btn-sm">
                                <i class="fas fa-edit"></i>
                                Ganti Password
                            </a>
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
                                            <input class="form-control @error('inpName') is-invalid @enderror"
                                                type="text" name="inpName" id="inpName"
                                                value="@if (old('inpName')) {{ old('inpName') }}@else{{ $user->name }} @endif">
                                            @error('inpName')
                                                <div id="inpNameFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>

                                    @pasien
                                        <tr>
                                            <th><label for="inpGender">Jenis Kelamin</label></th>
                                            <td>
                                                <select class="form-control @error('inpGender') is-invalid @enderror"
                                                    name="inpGender" id="inpGender">
                                                    <option selected value="{{ $user->getPasien()->gender ? 1 : 2 }}">
                                                        {{ $user->getPasien()->gender() }}</option>
                                                    <option value="1">Laki-laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                                @error('inpGender')
                                                    <div id="inpGenderFeedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><label for="inpBorn">Tanggal Lahir</label></th>
                                            <td>
                                                <div class="input-group date" id="born-date" data-target-input="nearest">
                                                    <input name="inpBorn" id="born-date-field" type="text"
                                                        class="form-control datetimepicker-input @error('inpBorn') is-invalid @enderror"
                                                        data-target="#born-date"
                                                        value="@if (old('inpBorn')) {{ old('inpBorn') }}@else{{ $user->getPasien()->born() }} @endif" />
                                                    <div class="input-group-append" data-target="#born-date"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                    @error('inpBorn')
                                                        <div id="inpBornFeedback" class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><label for="inpWeight">Berat Badan</label></th>
                                            <td>
                                                <input class="form-control @error('inpWeight') is-invalid @enderror"
                                                    type="number" name="inpWeight" id="inpWeight"
                                                    value="@if (old('inpWeight')) {{ old('inpWeight') }}@else{{ $user->getPasien()->weight }} @endif">
                                                @error('inpWeight')
                                                    <div id="inpWeightFeedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><label for="inpHeight">Tinggi Badan</label></th>
                                            <td>
                                                <input class="form-control @error('inpHeight') is-invalid @enderror"
                                                    type="number" name="inpHeight" id="inpHeight"
                                                    value="@if (old('inpHeight')) {{ old('inpHeight') }}@else{{ $user->getPasien()->height }} @endif">
                                                @error('inpHeight')
                                                    <div id="inpHeightFeedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endpasien
                                </table>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-12 mb-3 ">
                                        <img class="img img-fluid" src="{{ $user->getAvatar() }}" alt="">
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Ganti Avatar</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" accept="image/*" class="custom-file-input"
                                                            id="imgAvatar" name="imgAvatar">
                                                        <label class="custom-file-label" for="exampleInputFile">Pilih
                                                            gambar...</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @pasien
            <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
                <div class="card bg-gray-light">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="h6">Riwayat Penyakit</span>
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
        @endpasien
    </div><!-- /.container-fluid -->
@endsection

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('plugins/dropzone/dropzone.css')}}"> --}}
@endsection

@section('scripts')

    {{-- <script src="{{asset('plugins/dropzone/dropzone.js')}}"/> --}}
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        @pasien
        //Date picker
        $('#born-date').datetimepicker({
            format: 'DD/MM/YYYY',
            viewDate: '{{ $user->getPasien()->born }}'
        });

        $('#born-date-field').val('{{ $user->getPasien()->born() }}')
        @endpasien

        $(function() {
            bsCustomFileInput.init();
        });
    </script>

@endsection
