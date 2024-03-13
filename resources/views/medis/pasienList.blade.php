@extends('layouts.app-sidebar')

@section('page-title')
    Daftar Pasien
@endsection

@section('content')
    <div class="d-flex flex-column p-2">
        <div>
            <table id="tabelPasien" class="display text-black">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th class="col-4">Nama Pasien</th>
                        <th class="col-2">Usia</th>
                        <th class="col-2">Jenis Kelamin</th>
                        <th class="col-2">Aksi BB, Riwayat</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-1">Usia</td>
                        <td class="col-4">Nama Pasien</td>
                        <td class="col-2">Jenis Kelamin</td>
                        <td class="col-2">Aksi BB, Riwayat</td>
                        <td class="col-2">No</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let table = new DataTable('#tabelPasien', {
            responsive: true
        });
    </script>
@endsection
