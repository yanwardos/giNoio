@extends('layouts.adminlte-sidebar')

@section('page-title')
    Dashboard
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
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
        <div class="col-12 col-lg-8 d-flex flex-column p-2">
            <div class="d-flex p-2">
                <article class="card bg-gray-light text-center">
                    <div class="card-body">
                        <p class="h2">100</p>
                    </div>
                    <div class="card-footer">
                        <strong>Jumlah Pasien</strong>
                    </div>
                </article>
            </div>
            <div class="row p-2 mt-2">
                <div class="col-12 col-lg-6 mb-2">
                    <article class="card bg-gray-light">
                        <div class="card-body">
                            <h5 class="card-title">Pasien melakukan terapi</h5>
                            <div>

                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-lg-6 mb-2">
                    <article class="card bg-gray-light">
                        <div class="card-body">
                            <h5 class="card-title">Pasien melakukan terapi</h5>
                            <div>

                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
