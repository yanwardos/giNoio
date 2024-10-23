@extends('layouts.adminlte-sidebar')

@section('page-title')
    Profil saya
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profil saya</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Profil saya</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content-main')
    <div class="container-fluid">
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <div class="card bg-gray-light">
                <div class="card-header">
                    <div class="card-title">
                        <span class="h6">Data Profil</span>
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('profile.edit') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <table class="table table-borderless ">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>

                                @pasien
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $user->getPasien()->gender() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usia</th>
                                        <td>{{ $user->getPasien()->age() }}<strong> tahun</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Berat Badan</th>
                                        <td>{{ $user->getPasien()->weight }}<strong> kg</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Tinggi Badan</th>
                                        <td>{{ $user->getPasien()->height }}<strong> cm</strong></td>
                                    </tr>
                                @endpasien
                            </table>
                        </div>
                        <div class="col-4">
                            <img class="img img-fluid" src="{{ $user->getAvatar() }}" alt="">
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        @pasien
            <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
                <div class="card bg-gray-light">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="h6">Riwayat Penyakit</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                {{$user->getPasien()->illnessHistory}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        @endpasien
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
