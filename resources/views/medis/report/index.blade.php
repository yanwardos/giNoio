@extends('layouts.adminlte-sidebar')

@section('page-title')
    Laporan Data Monitoring
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Data Monitoring</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Laporan Data</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content-main')
    <div class="container-fluid">
        <div class="col-12 col-lg-11 col-xl-10 d-flex flex-column p-2">
            <div class="card bg-gray-light">
                <div class="card-body shadow">
                    <table id="tabelRiwayat" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-6">Nama Pasien</th>
                                <th class="col-3">Status Perangkat</th>
                                <th class="col-2">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pasiens as $pasien)
                                <tr>
                                    <td class="col-1">{{$no++}}</td>
                                    <td class="col-6">{{$pasien->user->name}}</td>
                                    <td class="col-3">
                                        @if(!$pasien->device)
                                            <small class="badge badge-warning">Belum memiliki perangkat.</small>
                                        @else
                                            <small class="badge badge-info nodeStateBadge" nodeSerial={{$pasien->device->serialNumber}}>offline</small>
                                        @endif

                                        <small></small>
                                    </td>
                                    <td class="col-2">
                                        <a href="{{route('medis.report.show.pasien', $pasien)}}" class="btn btn-block btn-secondary btn-xs">
                                            <i class="fas fa-info"></i>
                                            Lihat Laporan
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
    <x-mqtt-service-js />
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

            let nodes = $('.nodeStateBadge');

            if(nodes){
                nodes.each((idx, elem)=>{
                    let serialNum = $(elem).attr('nodeSerial');
                    nodes[idx].mq = new DeviceNode({
                        mqttClient: window._mqclient,
                        nodeSerial: serialNum,
                        onDataReceivedCallback: (m)=>{
                            $(elem).text('Online');
                            $(elem).removeClass('badge-info');
                            $(elem).addClass('badge-success');
                        },
                        onOfflineCallback: ()=>{
                            $(elem).text('Offline');
                            $(elem).removeClass('badge-success');
                            $(elem).addClass('badge-info');
                        }
                    });
                })
            }

        })
    </script>
@endsection
