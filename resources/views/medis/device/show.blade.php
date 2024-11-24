@extends('layouts.adminlte-sidebar')

@section('page-title')
    Detail Perangkat
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Perangkat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.devices') }}">Perangkat</a>
                    </li>
                    <li class="breadcrumb-item active">Detail</li>
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
                    <h3 class="card-title">
                        Registrasi
                    </h3>
                </div>
                <div class="card-body shadow">
                    <table class="table table-responsive table-borderless table-hover">
                        <tr>
                            <th>Nomor Seri</th>
                            <td>{{$device->serialNumber}}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Registrasi</th>
                            <td>
                                {{$device->created_at}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-11 col-xl-10">
            <div class="card bg-gray-light">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        Pasien
                    </h3>
                </div>
                <div class="card-body shadow">
                    @if ($device->pasien)
                        <table class="table table-responsive table-borderless table-hover">
                            <tr>
                                <th>Nama</th>
                                <td>{{$device->pasien->user->name}}</td>
                            </tr>
                        </table>
                        <br>
                        <button device-id="{{$device->id}}" pasien-id="{{$device->pasien->id}}" class="btn-unassign-pasien btn-assign-pasien btn btn-sm btn-danger">
                            Hapus Pasien
                        </button>
                    @else
                        <span class="badge badge-warning p-1">
                            Perangkat ini belum dipasangkan ke pasien.
                        </span>
                        <br>
                        <a class="btn btn-sm btn-primary mt-1" href="{{route('medis.device.assignPasien', $device)}}">
                            Pasangkan pasien
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-11 col-xl-10">
            <div class="card bg-gray-light">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        Log dan Status
                    </h3>
                </div>
                <div class="card-body shadow d-flex flex-column">
                    <div class="row">
                        <div class="col-2 col-lg-2 small-box bg-info mr-1 small-box-status">
                            <div class="inner">
                                <h4 class="small-box-status-text">
                                    Offline
                                </h4>
                                <p>Status</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <table class="table table-sm table-secondary font-weight-light">
                            <thead>
                                <tr>
                                    <th class="col-2">Log time</th>
                                    <th>Log</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>logtime</td>
                                    <td>logtext</td>
                                </tr>
                                <tr>
                                    <td>logtime</td>
                                    <td>logtext</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('styles')
@endsection

@section('scripts')
<x-mqtt-service-js />
<script>

    if (window._mqclient) {
        let nodeSerial = '{{ $device->serialNumber }}';
        new DeviceNode({
            mqttClient: window._mqclient,
            nodeSerial: nodeSerial,
            onDataReceivedCallback: (m)=>{
                $('.small-box-status-text').text('Online');
                $('.small-box-status').removeClass('bg-info');
                $('.small-box-status').addClass('bg-success');
            },
            onOfflineCallback: ()=>{
                $('.small-box-status-text').text('Offline');
                $('.small-box-status').removeClass('bg-success');
                $('.small-box-status').addClass('bg-info');
            }
        });
    }
</script>
@endsection
