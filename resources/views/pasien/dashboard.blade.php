@extends('layouts.adminlte-sidebar')

@section('page-title')
    Dashboard
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Pasien</h1>
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
        <div class="col-12 col-lg-10 d-flex flex-column p-2">
            <div class="row p-2">
                <div class="col-12">
                    <article class="card bg-gray-light">
                        <div class="card-header bg-success">
                            <div class="card-title">
                                <span class="h6">Tentang</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-justify">
                                IGoniometer merupakan goniometer digital yang dirancang untuk mengukur sudut gerakan sendi
                                sekaligus memantau aktivitas listrik otot. Dengan teknologi digital, alat ini menawarkan
                                pembacaan yang lebih mudah dan cepat dibandingkan dengan goniometer analog. Biasanya
                                digunakan dalam berbagai bidang seperti kedokteran.
                            </p>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row p-2 mt-2">
                <div class="col-12 col-md-7 mb-2">
                    <article class="card bg-gray-light">
                        <div class="card-header bg-success">
                            <div class="card-title">
                                <span class="h6">Informasi Alat</span>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (!$pasien->device)
                                <div class="row">
                                    <p>
                                        Hubungi tim kami untuk melakukan meregistrasi alat pada akun anda.
                                    </p>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <div id="info-device-status" class="info-box mb-3 bg-secondary">
                                            <span class="info-box-icon"><i class="fas fa-desktop"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-number status-text">Offline</span>
                                                <span class="info-box-text status-time">
                                                    Pemakaian terakhir: 
                                                    @if ($monitoringRecords)
                                                        {{$monitoringRecords->first()->created_at;}}
                                                    @endif
                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="small-box" style="background-color: #39cc39;">
                                            <div class="inner text-center">
                                                <small><strong>Flexi-Ektensi</strong></small>
                                                <h3><span id="mpu-flex-ext">00</span>&deg;</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="small-box" style="background-color: #39cccc;">
                                            <div class="inner text-center">
                                                <small><strong>Adduksi-Abduksi</strong></small>
                                                <h3><span id="mpu-add-abd">00</span>&deg;</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="small-box" style="background-color: #cc39cc;">
                                            <div class="inner text-center">
                                                <small><strong>Suponasi</strong></small>
                                                <h3><span id="mpu-suponasi">00</span>&deg;</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </article>
                </div>
                <div class="col-12 col-md-5 mb-2">
                    <article class="card bg-gray-light">
                        <div class="card-header bg-success">
                            <div class="card-title">
                                <span class="h6">Biodata Pasien</span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <img class="img-fluid img-circle mb-2" src="{{ $pasien->user->getAvatar() }}" alt="Avatar"
                                style="height: 100px; width: 100px; ">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th class="text-right col-6 py-0 pb-1">Nama</th>
                                    <td class="col-6 py-0">
                                        {{ $pasien->user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right py-0 pb-1">Jenis Kelamin</th>
                                    <td class="py-0">
                                        {{ $pasien->gender() }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right py-0 pb-1">Umur</th>
                                    <td class="py-0">
                                        {{ $pasien->age() }} tahun
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right py-0 pb-1">Berat Badan</th>
                                    <td class="py-0">
                                        {{ $pasien->weight }} kg
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right py-0 pb-1">Riwayat Penyakit</th>
                                    <td class="py-0">
                                        {{ $pasien->illnessHistory }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <x-mqtt-service-js />
        <script>
            let serialNum = "{{$pasien->device->serialNumber}}";
    
            let mqtNodeMessageHandler = (message) => {
                let payload = JSON.parse(message);
                $('#mpu-flex-ext').text(payload.x);
                $('#mpu-add-abd').text(payload.y);
                $('#mpu-suponasi').text(payload.z);
                console.log(payload);
            }

            let timeNow = ()=>{
                let time = new Date();
                return time.getFullYear() + '-' + (time.getMonth()+1) + '-' + time.getDate() + '-' + time.getHours() + ':' + time.getMinutes() + ':' + time.getSeconds();
            }

            let lastActive;

            node = new DeviceNode({
                mqttClient: window._mqclient,
                nodeSerial: serialNum,
                onDataReceivedCallback: (m)=>{ 
                    lastActive = timeNow();
                    $('#info-device-status').removeClass('bg-secondary');
                    $('#info-device-status').addClass('bg-success');

                    $('#info-device-status i').removeClass('text-dark');
                    $('#info-device-status i').addClass('text-primary'); 

                    $('#info-device-status .status-text').text('Online'); 
                    $('#info-device-status .status-time').text('Waktu data: ' + lastActive);
                    mqtNodeMessageHandler(m);
                },
                onOfflineCallback: ()=>{ 
                    $('#info-device-status').removeClass('bg-success');
                    $('#info-device-status').addClass('bg-secondary');

                    $('#info-device-status i').removeClass('text-primary');
                    $('#info-device-status i').addClass('text-dark');

                    $('#info-device-status .status-text').text('Offline'); 
                    $('#info-device-status .status-time').text('Pemakaian terakhir: ' + lastActive);
                }
            });
        </script>
        

    @endsection