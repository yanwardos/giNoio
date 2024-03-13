@extends('layouts.app-sidebar')

@section('page-title')
    Dashboard
@endsection

@section('content')
    <div class="d-flex p-2">
        <div class="card text-center">
            <div class="card-body">
                <p class="card-title h1">100</p>
            </div>
            <div class="card-footer h6">
                JUMLAH PASIEN
            </div>
        </div>
    </div>
    <div class="row p-2 mt-2">
        <div class="col-12 col-lg-6 mb-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pasien melakukan terapi</h5>
                    <div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tren kunjungan pasien</h5>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
