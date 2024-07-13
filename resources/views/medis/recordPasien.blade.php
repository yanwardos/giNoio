@extends('layouts.adminlte-sidebar')

@section('page-title')
    Monitoring
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Monitoring {{$pasien->user->name}}</h1>
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
        @if(!$pasien->device) 
            <div class="col-12 col-lg-11 col-xl-10 d-flex flex-column p-2">
                <div class="card bg-gray-light"> 
                    <div class="card-body shadow">
                        <small class="badge badge-warning">Pasien ini belum memiliki perangkat.</small> 
                        <br>
                        <a class="btn btn-sm btn-primary mt-2" href="{{route('medis.pasien.assignDevice', $pasien->id)}}">
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
                            <table class="table table-sm table-borderless table-responsive">
                                <tbody>
                                    <tr>
                                        <th>Nomor Seri</th>
                                        <td>{{$pasien->device->serialNumber}}</td>
                                    </tr>
                                    <tr>
                                        <th>Registrasi</th>
                                        <td>{{$pasien->device->created_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <button pasien-id="{{$pasien->id}}" class="btn-unassign-device btn btn-sm btn-danger">
                                Hapus Perangkat
                            </button>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="small-box bg-info mr-1">
                                <div class="inner">
                                    <h4>
                                        Online
                                    </h4> 
                                    <p>Status</p>
                                </div>  
                            </div>
                            <div class="small-box bg-info mr-1">
                                <div class="inner">
                                    <h4>150<sup>h</sup></h4> 
                                    <p>Uptime</p>
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
                        Data MPU
                    </h3> 
                    </div>
                    <div class="card-body shadow d-flex flex-row">
                        <div class="flex-fill d-flex justify-content-center align-items-center">
                            <canvas class="chart" id="mpu-canvas" style=" height:100%; width:100%"></canvas>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-centr m-2"> 
                            <div class="d-flex flex-column justify-content-start align-items-center m-2">
                                <input type="text" class="knob" id="knob-x" data-readonly="true" data-width="60" data-height="60" value="56" data-fgColor="#39cc39" displayPrevious="true">
                                <span class="badge mt-2"> &deg X</small>
                            </div>
                            <div class="d-flex flex-column justify-content-start align-items-center m-2">
                                <input type="text" class="knob" id="knob-y" data-readonly="true" data-width="60" data-height="60" value="56" data-fgColor="#39cccc" displayPrevious="true">
                                <span class="badge mt-2" > &deg Y</small>
                            </div>
                            <div class="d-flex flex-column justify-content-start align-items-center m-2">
                                <input type="text" class="knob" id="knob-z" data-readonly="true" data-width="60" data-height="60" value="56" data-fgColor="#cc39cc" displayPrevious="true">
                                <span class="badge mt-2"> &deg Z</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-11 col-xl-10">
                <div class="card bg-gray-light">
                    <div class="card-header border-0">
                    <h3 class="card-title">
                        Data EMG 
                    </h3> 
                    </div>
                    <div class="card-body shadow d-flex flex-row">
                        <div class="flex-fill d-flex justify-content-center align-items-center">
                            <canvas class="chart" id="emg-canvas" style=" height:100%; width:100%"></canvas>
                        </div> 
                        <div class="d-flex flex-column justify-content-center align-items-center m-2">
                            <div class="progress vertical active">
                            <div id="progress-emg" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="height: 100%"
                                style="background-color: #cc3939!important;"
                                > 
                            </div>
                            </div>
                            <span class="badge text-white mt-2" style="background-color: #cc3939">V EMG</small> 
                        </div>
                    </div>
                </div>
            </div>
        @endif 
    </div><!-- /.container-fluid -->
@endsection

@section('styles') 
@endsection

@section('scripts') 
    <script>
        @if ($pasien->device)
            /* jQueryKnob */
            $('.knob').knob()

            // Chart MPU
            var mpuChartCanvas = $('#mpu-canvas').get(0).getContext('2d')

            var mpuChartData = {
                labels: [
                    1, 2, 3, 4, 5, 6, 7
                ],
                datasets: [
                    {
                        label: 'Sudut X',
                        'fill': false,
                        borderWidth: 2,
                        lineTension: 0,
                        spanGaps: true,
                        borderColor: '#39cc39',
                        pointBackgroundColor: '#39cc39',
                        data: [2666, 2778, 4912, 3767, 6810, 5670, 4820] 
                    }, {
                        label: 'Sudut Y',
                        'fill': false,
                        borderWidth: 2,
                        lineTension: 0,
                        spanGaps: true,
                        borderColor: '#39cccc',
                        pointBackgroundColor: '#39cccc',
                        data: [200, 3000, 2000, 4000, 5000, 4500, 2344] 
                    }, {
                        label: 'Sudut Z',
                        'fill': false,
                        borderWidth: 2,
                        lineTension: 0,
                        spanGaps: true,
                        borderColor: '#cc39cc',
                        pointBackgroundColor: '#cc39cc',
                        data: [3455, 3455, 5444, 3342, 5424, 5543, 2343] 
                    }
                ]
            }

            var mpuChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: '#efefef'
                        },
                        gridLines: {
                            display: false,
                            color: '#efefef',
                            drawBorder: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                        stepSize: 1000,
                            fontColor: '#efefef'
                        },
                        gridLines: {
                            display: true,
                            color: '#efefef',
                            drawBorder: false
                        }
                    }]
                }
            } 

            var mpuGraphChart = new Chart(
                mpuChartCanvas,
                {
                    type: 'line',
                    data: mpuChartData,
                    options: mpuChartOptions
                }
            )

            // Chart EMG
            var emgChartCanvas = $('#emg-canvas').get(0).getContext('2d');
            var emgChartData = { 
                labels: [
                    1, 2, 3, 4, 5, 6, 7
                ],
                datasets: [
                    {
                        label: 'Sudut X',
                        'fill': false,
                        borderWidth: 2,
                        lineTension: 0,
                        spanGaps: true,
                        borderColor: '#cc3939',
                        pointBackgroundColor: '#cc3939',
                        data: [2666, 2778, 4912, 3767, 6810, 5670, 4820] 
                    },
                ]
            }
            var emgChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: '#efefef'
                        },
                        gridLines: {
                            display: false,
                            color: '#efefef',
                            drawBorder: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                        stepSize: 1000,
                            fontColor: '#efefef'
                        },
                        gridLines: {
                            display: true,
                            color: '#efefef',
                            drawBorder: false
                        }
                    }]
                }

            }
            var emgGraphChart = new Chart(
                emgChartCanvas,
                {
                    type: 'line',
                    data: emgChartData,
                    options: emgChartOptions
                }
            )

            
            var isUnassigning = false;
            $('.btn-unassign-device').click((event)=>{
                if(isUnassigning) return;
                isUnassigning = true;
                var pasienId = $(event.target).attr('pasien-id');
                
                $.ajax({
                    url: "{{route('medis.pasien.unassignDevice.store')}}",
                    method: 'POST',
                    data: {
                        pasienId: pasienId,
                    },
                    success: (response)=>{
                        isUnassigning = false;
                        window.location.replace("{{route('medis.records.pasien', $pasien->id)}}");
                    },
                    error: (jqXHR, textStatus, errorThrown)=>{
                        isUnassigning = false;
                    }
                })
            })
            
        @endif

    </script>
@endsection
