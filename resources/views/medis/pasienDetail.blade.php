@extends('layouts.adminlte-sidebar')

@section('page-title')
    Detail Pasien
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Pasien</h1>
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
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <div class="card bg-gray-light">
                <div class="card-header">
                    <div class="card-title"> 
                        <span class="h6">Data Pasien</span>
                    </div>
                    <div class="card-tools">
                        <a href="{{route('medis.pasienEdit', $pasien)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <button   class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-reset-password">
                            <i class="fas fa-key"></i>
                            Reset Password
                        </button>
                        <button   class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-pasien">
                            <i class="fas fa-trash"></i>
                            Hapus
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row"> 
                        <div class="col-8">
                            <table class="table table-borderless ">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{$pasien->user->name}}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{$pasien->gender()}}</td>
                                </tr>
                                <tr>
                                    <th>Usia</th>
                                    <td>{{$pasien->age()}}</td>
                                </tr>
                                <tr>
                                    <th>Berat Badan</th>
                                    <td>{{$pasien->weight}}</td>
                                </tr>
                                <tr>
                                    <th>Tinggi Badan</th>
                                    <td>{{$pasien->height}}</td>
                                </tr>
                                <tr>
                                    <th>Riwayat Penyakit</th>
                                    <td>
                                        <!-- TODO: RIWAYAT PENYAKIT -->
                                    </td>
                                </tr>
                            </table> 
                        </div>
                        <div class="col-4">
                            <img class="img img-fluid" src="{{$pasien->user->getAvatar()}}" alt="">
                        </div>
                        <hr> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <div class="card bg-gray-light">
                <div class="card-header">
                    <div class="card-title"> 
                        <span class="h6">Riwayat Terapi</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- TODO: RIWAYAT -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    
    <div class="modal fade" id="modal-delete-pasien">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Peringatan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>
                    Pasien berikut akan dihapus dari sistem.
                    <br>
                    <strong>{{$pasien->user->name}}</strong>
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                <form action="{{route('medis.pasienDelete', $pasien)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus pasien</button>
                </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-reset-password">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Reset password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>
                    Reset password untuk pasien berikut?
                    <br>
                    <strong>{{$pasien->user->name}}</strong>
                    <br>
                    Password default adalah: <strong>{{env('USER_DEFAULT_PASSWORD')}}</strong>
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                <form action="{{route('medis.pasienPasswordReset', $pasien)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reset Password</button>
                </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
