@extends('layouts.app-sidebar')

@section('page-title')
    Riwayat Terapi
@endsection

@section('content')
    <div class="d-flex flex-column p-2">
        <div>
            <table id="tabelPasien" class="display text-black">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th class="col-5">Nama Pasien</th>
                        <th class="col-2">Waktu</th>
                        <th class="col-2">Durasi</th>
                        <th class="col-2">Aksi detail</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-1">No</td>
                        <td class="col-5">Nama Pasien</td>
                        <td class="col-2">Waktu</td>
                        <td class="col-2">Durasi</td>
                        <td class="col-2">Aksi detail</td>
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
