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
        <div class="col-12 col-lg-11 col-xl-10 d-flex flex-column p-2">
            <div class="card bg-gray-light">
                <div class="card-body">
                    <table id="tabelPasien" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-4">Nama Pasien</th>
                                <th class="col-2">Email</th>
                                <th class="col-1">Usia</th>
                                <th class="col-1">Jenis Kelamin</th>
                                <th class="col-2">Aksi BB, Riwayat</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 1;
                            @endphp
                            @if ($pasiens)
                                @foreach ($pasiens as $pasien)
                                <tr>
                                    <td class="col-1">{{$num++}}</td>
                                    <td class="col-4">{{$pasien->user->name}}</td>
                                    <td class="col-2">{{$pasien->user->email}}</td>
                                    <td class="col-1">{{$pasien->age()}}</td>
                                    <td class="col-1">{{$pasien->gender?'Pria':'Wanita'}}</td>
                                    <td class="col-2">
                                        <a href="{{route('medis.pasien.show', $pasien)}}" class="btn btn-block btn-warning btn-xs">
                                            <i class="fas fa-info"></i>
                                            Detail
                                        </a>
                                        <a href="{{route('medis.pasien.edit', $pasien)}}" class="btn btn-block btn-info btn-xs">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
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
