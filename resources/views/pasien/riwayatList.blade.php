@extends('layouts.adminlte-sidebar')

@section('page-title')
    Riwayat Terapi
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Riwayat Terapi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Riwayat Terapi</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content-main')
    <div class="container-fluid">
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <div class="card bg-gray-light">
                <div class="card-body shadow">
                    <table id="tabelRiwayat" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-5">Waktu terapi</th>
                                <th class="col-2">Durasi</th>
                                <th class="col-2">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-1">No</td> 
                                <td class="col-2">Waktu</td>
                                <td class="col-2">Durasi</td>
                                <td class="col-2">Aksi detail</td>
                            </tr>
                            <tr>
                                <td class="col-1">No</td> 
                                <td class="col-2">Waktu</td>
                                <td class="col-2">Durasi</td>
                                <td class="col-2">Aksi detail</td>
                            </tr>
                            <tr>
                                <td class="col-1">No</td> 
                                <td class="col-2">Waktu</td>
                                <td class="col-2">Durasi</td>
                                <td class="col-2">Aksi detail</td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('styles')
    <x-datatable-css />
@endsection

@section('scripts')
    <x-datatable-js />
    <script>
        $(function() {
            $('#tabelRiwayat').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>
@endsection
