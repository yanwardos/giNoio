@extends('layouts.adminlte-sidebar')

@section('page-title')
    Laporan Monitoring
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Monitoring {{ $pasien->user->name }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('medis.report.index') }}">Laporan Monitoring</a>
                    </li>
                    <li class="breadcrumb-item active">{{$pasien->user->name}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content-main')
    <div class="container-fluid">
        @if (!$pasien->device)
            <div class="col-12 col-lg-11 col-xl-10 d-flex flex-column p-2">
                <div class="card bg-gray-light">
                    <div class="card-body shadow">
                        <small class="badge badge-warning">Pasien ini belum memiliki perangkat.</small>
                        <br>
                        <a class="btn btn-sm btn-primary mt-2" href="{{ route('medis.pasien.assignDevice', $pasien->id) }}">
                            Pasangkat perangkat
                        </a>
                    </div>
                </div>
            </div>
        @else

            <div class="col-12 col-lg-11 col-xl-10">
                <div class="card bg-gray-light">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            Data Historis
                        </h3>
                    </div>
                    <div class="card-body shadow">
                        <table id="tabelDataMonitoring" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th class="col-4">Tanggal Data</th>
                                    <th class="col-4">Jumlah Data</th>
                                    <th class="col-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($recordDates as $dates)
                                    <tr>
                                        <td>
                                            {{$no++}}
                                        </td>
                                        <td>
                                            {{$dates->date}}
                                        </td>
                                        <td>
                                            {{$dates->count}}
                                        </td>
                                        <td>
                                            <a class="badge badge-info" href="#">
                                                Lihat Grafik
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div><!-- /.container-fluid -->
@endsection

@section('styles')
<x-datatable-css />
@endsection

@section('scripts')
    <x-datatable-js />
    <x-mqtt-service-js />
    <script src="{{ asset('js/chartDriver.js') }}"></script>
    <script>
        $(function() {
            $('#tabelDataMonitoring').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            @if ($pasien->device)
                let nodeSerial = '{{ $pasien->device->serialNumber }}';

                let mqtNodeMessageHandler = (message) => {
                    let payload = JSON.parse(message);
                    addDataMPU(payload);
                    addDataEMG(payload);
                }

                if (window._mqclient) {
                    new DeviceNode({
                        mqttClient: window._mqclient,
                        nodeSerial: nodeSerial,
                        onDataReceivedCallback: (m)=>{
                            $('.small-box-status-text').text('Online');
                            $('.small-box-status').removeClass('bg-info')
                            $('.small-box-status').addClass('bg-success')
                            mqtNodeMessageHandler(m);
                        },
                        onOfflineCallback: ()=>{
                            $('.small-box-status-text').text('Offline');
                            $('.small-box-status').removeClass('bg-success')
                            $('.small-box-status').addClass('bg-info')
                        }
                    });
                }

                /* jQueryKnob */
                $('.knob').knob({
                    'min': 0,
                    'max': 360
                })

                var isUnassigning = false;
                $('.btn-unassign-device').click((event) => {
                    if (isUnassigning) return;
                    isUnassigning = true;
                    var pasienId = $(event.target).attr('pasien-id');

                    $.ajax({
                        url: "{{ route('medis.pasien.unassignDevice.store') }}",
                        method: 'POST',
                        data: {
                            pasienId: pasienId,
                        },
                        success: (response) => {
                            isUnassigning = false;
                            window.location.replace("{{ route('medis.report.index') }}");
                        },
                        error: (jqXHR, textStatus, errorThrown) => {
                            isUnassigning = false;
                        }
                    })
                })
            @endif
        })

    </script>
@endsection
