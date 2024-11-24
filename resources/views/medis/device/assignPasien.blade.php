@extends('layouts.adminlte-sidebar')

@section('page-title')
    Pasangkan Pasien ke Perangkat
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pasangkan Pasien ke Perangkat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('medis.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Detail Perangkat</li>
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
                        Pilih Pasien
                    </h3>
                </div>
                <div class="card-body shadow">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-5">Nama</th>
                                <th class="col-3">Aksi</th>
                            </tr>
                        </thead>
                        @php
                            $num = 1;
                        @endphp
                        <tbody>
                            @foreach ($pasiens as $pasien)
                                @if(!$pasien->device)
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$pasien->user->name}}</td>
                                        <td>
                                            <button device-id="{{$device->id}}" pasien-id="{{$pasien->id}}" class="btn-assign-pasien btn btn-sm btn-primary">
                                                Pasangkan
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('styles')
@endsection

@section('scripts')
<script>
    console.log('ok');
    var isAssigning = false;
    $('.btn-assign-pasien').click((event)=>{
        if(isAssigning) return;
        isAssigning = true;
        var pasienId = $(event.target).attr('pasien-id');
        var deviceId = $(event.target).attr('device-id');

        $.ajax({
            url: "{{route('medis.pasien.assignDevice.store')}}",
            method: 'POST',
            data: {
                pasienId: pasienId,
                deviceId: deviceId
            },
            success: (response)=>{
                isAssigning = false;
                window.location.replace("{{route('medis.device', $device->id)}}");
            },
            error: (jqXHR, textStatus, errorThrown)=>{
                isAssigning = false;
            }
        })
    })
</script>
@endsection
