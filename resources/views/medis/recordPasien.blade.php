@extends('layouts.adminlte-sidebar')

@section('page-title')
    Monitoring
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Monitoring {{ $pasien->user->name }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Monitoring</li>
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
            <div class="col-12 col-lg-11 col-xl-10 p-2">
                <div class="card bg-gray-light">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            Status Alat
                        </h3>
                    </div>
                    <div class="card-body shadow d-flex flex-row">
                        <div class="w-100 m-2">
                            <hello-vue />
                            <table class="table table-sm table-borderless table-responsive">
                                <tbody>
                                    <tr>
                                        <th>Nomor Seri</th>
                                        <td>{{ $pasien->device->serialNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th>Registrasi</th>
                                        <td>{{ $pasien->device->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <button pasien-id="{{ $pasien->id }}" class="btn-unassign-device btn btn-sm btn-danger">
                                Hapus Perangkat
                            </button>
                        </div>
                        <div class="d-flex flex-row"> 
                            <div class="small-box bg-info mr-1 small-box-status">
                                <div class="inner">
                                    <h4></h4>
                                    <p class="small-box-status-text">Offline</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-11 col-xl-10 p-2">
                <div class="card bg-gray-light">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            Data Live
                        </h3>
                        <div class="card-tools"> 
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex flex-row m-2 p-1 shadow">
                                    <div class="p-1 flex-fill">
                                        <canvas class="chart" id="mpu-canvas" style=" height:0px; width:100%"></canvas>
                                    </div>
                                    <div class="p-1">
                                        <div class="d-flex flex-column align-items-center justify-content-center m-2"> 
                                            <div class="d-flex flex-column justify-content-start align-items-center m-2">
                                                <input type="text" class="knob knob-x" id="knob-x" data-readonly="true"
                                                    data-width="60" data-height="60" value="56" data-fgColor="#39cc39"
                                                    displayPrevious="true">
                                                <span class="badge mt-2"> &deg X</small>
                                            </div>
                                            <div class="d-flex flex-column justify-content-start align-items-center m-2">
                                                <input type="text" class="knob knob-y" id="knob-y" data-readonly="true"
                                                    data-width="60" data-height="60" value="56" data-fgColor="#39cccc"
                                                    displayPrevious="true">
                                                <span class="badge mt-2"> &deg Y</small>
                                            </div>
                                            <div class="d-flex flex-column justify-content-start align-items-center m-2">
                                                <input type="text" class="knob knob-z" id="knob-z" data-readonly="true"
                                                    data-width="60" data-height="60" value="56" data-fgColor="#cc39cc"
                                                    displayPrevious="true">
                                                <span class="badge mt-2"> &deg Z</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex flex-row m-2 p-1 shadow">
                                    <div class="p-1 flex-fill">
                                        <canvas class="chart" id="emg-canvas" style=" height:100%; width:80%"></canvas>
                                    </div> 
                                    <div class="p-1">
                                        <div class="d-flex flex-column justify-content-center align-items-center m-2">
                                            <div class="progress vertical active">
                                                <div id="progress-emg" class="progress-bar progress-bar-striped progress-bar-animated"
                                                    role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"
                                                    style="height: 10%" style="background-color: #cc3939!important;">
                                                </div>
                                            </div>
                                            <span class="badge text-white mt-2" style="background-color: #cc3939">V EMG</small>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <th class="col-4">Nilai MPU</th>
                                    <th class="col-4">Nilai EMG</th>
                                    <th class="col-3">Waktu Data</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($records as $record) 
                                    <tr>
                                        <td>
                                            {{$no}}
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-pill py-1 px-2">
                                                X: {{$record->data->x ?? '-'}} | Y: {{$record->data->y ?? '-'}} | Z: {{$record->data->z ?? '-'}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-pill py-1 px-2">
                                                {{$record->data->emg ?? '-'}}
                                            </span>
                                        </td>
                                        <td>
                                            <small>
                                                {{$record->created_at ?? '-'}}
                                            </small>
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
                            window.location.replace("{{ route('medis.records.pasien', $pasien->id) }}");
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
