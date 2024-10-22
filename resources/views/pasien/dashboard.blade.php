@extends('layouts.adminlte-sidebar')

@section('page-title')
    Dashboard
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Pasien</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection


@section('content-main')
    <div class="container-fluid">
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <div class="row p-2">
                <div class="col-3">
                    {{-- <article class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <h3p>Jumlah Terapi</h3p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </article> --}}
                </div> 
            </div>
            <div class="row p-2 mt-2">
                <div class="col-12 col-lg-6 mb-2">
                    <article class="card bg-gray-light">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="h6">Informasi Alat</span>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>
                                Hubungi tim kami untuk melakukan meregistrasi alat pada akun anda.
                            </p>
                        </div>
                    </article>
                </div>
                {{-- <div class="col-12 col-lg-6 mb-2">
                    <article class="card bg-gray-light">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="h6">Info</span>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias nihil, fugit odio a quasi pariatur vero beatae earum, dicta neque fugiat laborum praesentium est vel modi nemo maiores eligendi non!
                            </div>
                        </div>
                    </article>
                </div> --}}
            </div>
        </div>
    @endsection
