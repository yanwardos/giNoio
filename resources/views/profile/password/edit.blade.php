@extends('layouts.adminlte-sidebar')

@section('page-title')
    Ganti Password
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ganti Password</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('profile') }}">Profil saya</a>
                    </li>
                    <li class="breadcrumb-item active">Ganti Password</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
@endsection

@section('content-main')

    <div class="container-fluid">
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <form action="{{ route('profile.password.update') }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="card bg-gray-light">
                    <div class="card-header">
                        <div class="card-title"> 
                        </div>
                        <div class="card-tools"> 
                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="fas fa-save"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <label for="newPassword"
                                class="col-12 col-md-3 col-form-label text-start">
                                Password Baru
                            </label>

                            <div class="col-12 col-md-5">  
                                <div class="input-group" id="newPasswordGroup">
                                    <input id="newPassword" type="password"
                                        class=" form-control @error('newPassword') is-invalid @enderror" name="newPassword"
                                        required autocomplete="current-password">

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <a href="#" style="text-decoration: none; color: black" >
                                                <i class="fas fa-eye-slash passwordToggle" target="newPasswordGroup"></i>
                                            </a>
                                        </span>
                                    </div>
                                    @error('newPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        
                        <div class="row mb-2">
                            <label for="confirmPassword"
                                class="col-12 col-md-3 col-form-label text-start">
                                Konfirmasi Password Baru
                            </label>

                            <div class="col-12 col-md-5">  
                                <div class="input-group" id="confirmPasswordGroup">
                                    <input id="confirmPassword" type="password"
                                        class=" form-control @error('confirmPassword') is-invalid @enderror" name="confirmPassword"
                                        required autocomplete="current-password">

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <a href="#" style="text-decoration: none; color: black" >
                                                <i class="fas fa-eye-slash passwordToggle" target="confirmPasswordGroup"></i>
                                            </a>
                                        </span>
                                    </div>
                                    @error('confirmPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        
                        <div class="row mb-2">
                            <label for="oldPassword"
                                class="col-12 col-md-3 col-form-label text-start">
                                Password Lama
                            </label>

                            <div class="col-12 col-md-5">  
                                <div class="input-group" id="oldPasswordGroup">
                                    <input id="oldPassword" type="password"
                                        class=" form-control @error('oldPassword') is-invalid @enderror" name="oldPassword"
                                        required autocomplete="current-password">

                                    <div class="input-group-append " >
                                        <span class="input-group-text " >
                                            <a href="#" style="text-decoration: none; color: black" >
                                                <i class="fas fa-eye-slash passwordToggle" target="oldPasswordGroup"></i>
                                            </a>
                                        </span>
                                    </div>
                                    @error('oldPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div> 
                    </div>
                </div>
            </form>
        </div>
 
    </div><!-- /.container-fluid -->
@endsection

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('plugins/dropzone/dropzone.css')}}"> --}}
@endsection

@section('scripts')

    {{-- <script src="{{asset('plugins/dropzone/dropzone.js')}}"/> --}}
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script> 
        $(function() {
            bsCustomFileInput.init();
        });

        
        $(document).ready(function(){ 
            $('.passwordToggle').on('click', (event)=>{
                event.preventDefault();
                var target = $(event.target)[0];
                var target = $(target).attr('target'); 
                
                if($('#'+target+' input').attr("type") == "text"){
                    $('#'+target+' input').attr('type', 'password');
                    $('#'+target+' i').addClass( "fa-eye-slash" );
                    $('#'+target+' i').removeClass( "fa-eye" );
                }else if($('#'+target+' input').attr("type") == "password"){
                    $('#'+target+' input').attr('type', 'text');
                    $('#'+target+' i').removeClass( "fa-eye-slash" );
                    $('#'+target+' i').addClass( "fa-eye" );
                }
            })
        })
    </script>

@endsection
 