@extends('layouts.adminlte-sidebar')

@section('page-title')
    Daftar Pasien
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Pasien</h1>
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
            <div class="card bg-gray-light">
                <div class="card-body">
                    <table id="tabelPasien" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-4">Nama Pasien</th>
                                <th class="col-2">Usia</th>
                                <th class="col-2">Jenis Kelamin</th>
                                <th class="col-2">Aksi BB, Riwayat</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-1">Usia</td>
                                <td class="col-4">Nama Pasien</td>
                                <td class="col-2">Jenis Kelamin</td>
                                <td class="col-2">Aksi BB, Riwayat</td>
                                <td class="col-2">No</td>
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
            $('#tabelPasien').DataTable({
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
