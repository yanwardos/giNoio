@extends('layouts.adminlte-sidebar')

@section('page-title')
    Daftar Perangkat Igoniometer
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Perangkat Igoniometer</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Perangkat</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content-main')
    <div class="container-fluid">
        <div class="col-12 col-lg-11 col-xl-10 d-flex flex-column p-2">
            <div class="card bg-gray-light">
                <div class="card-header">

                </div>
                <div class="card-body shadow">
                    <table id="tabelRiwayat" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-4">Nomor Seri</th>
                                <th class="col-2">Tanggal Registrasi</th> 
                                <th class="col-2">Status</th>
                                <th class="col-3">Aksi detail</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($devices as $device) 
                                <tr>
                                    <td class="col-1">{{$no++}}</td>
                                    <td class="col-4">{{$device->serialNumber}}</td>
                                    <td class="col-2">
                                        <small>
                                            {{$device->created_at}}
                                        </small>
                                    </td> 
                                    <td class="col-1">
                                        @switch('online')
                                            @case('online')
                                                <small class="badge badge-success">Online</small>
                                            @break
                                    
                                            @case('offline')
                                                <small class="badge badge-danger">Offline</small>
                                            @break
                                            @default
                                                
                                        @endswitch
                                    </td>
                                    <td class="col-2"> 
                                        <a href="{{route('medis.device', $device)}}" class="btn btn-block btn-warning btn-xs">
                                            <i class="fas fa-info"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach 
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
