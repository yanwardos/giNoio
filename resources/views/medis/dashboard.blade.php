@extends('layouts.adminlte-sidebar')

@section('page-title')
    Dashboard
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
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
        <div class="col-12 col-lg-10 col-xl-8 d-flex flex-column p-2">
            <div class="row p-2">
                <div class="col-3">
                    <article class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                {{$jumlahPasien}}
                            </h3>
                            <p>Total Pasien</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div> 
                    </article>
                </div>
                <div class="col-3">
                    <article class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                {{$jumlahPasienLaki}}
                            </h3>
                            <p>Pasien Laki-laki</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div> 
                    </article>
                </div>
                <div class="col-3">
                    <article class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                {{$jumlahPasienPerempuan}}
                            </h3>
                            <p>Pasien Perempuan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div> 
                    </article>
                </div>
            </div>
            <div class="row p-2 mt-2">
                <div class="col-12 col-md-7 mb-2">
                    <article class="card bg-gray-light">
                        <div class="card-header bg-success">
                            <div class="card-title">
                                <span class="h6">Teknik Biomedis ITERA</span>
                            </div> 
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <img class="img img-fluid mb-2" src="{{asset('assets/img/biomedis-itera-logo.png')}}" alt="Logo Biomedis ITERA" style="height: 200px;">
                            <p class="text-justify">
                                Program Studi Teknik Biomedis (PS BM) merupakan salah satu program studi di Institut Teknologi Sumatera (ITERA) yang resmi dibuka pada tahun 2019 dengan diterbitkannya SK Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor 694/KPT/I/2019 tentang izin pembukaan Program Studi Teknik Biomedis program sarjana pada Institut Teknologi Sumatera.
                                Pendirian PS BM akan mendukung visi dan misi ITERA dalam memenuhi ketersediaan sumber daya manusia di bidang Teknik Biomedis khususnya di wilayah Sumatera.
                            </p>
                            <p class="text-justify">
                                Program Studi Teknik Biomedis ITERA memiliki visi keilmuan untuk berkontribusi pada pengembangan sumber daya manusia serta inovasi teknologi biomedis yang unggul di tingkat nasional, regional, dan internasional dengan keunikan program studi yang meliputi bidang peminatan Instrumentasi dan Pengolahan Citra Biomedis serta peminatan Biomaterial dan Rekayasa Jaringan.
                                Dari sisi sistem atau bahan yang menjadi fokus kajian, baik dalam kelas maupun tugas akhir, kajian akan berfokus pada sistem, perangkat, bahan, maupun kondisi infrastruktur
                            </p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-md-5 mb-2">
                    <article class="card bg-gray-light">
                        <div class="card-header bg-success">
                            <div class="card-title">
                                <span class="h6">IGoniometer</span>
                            </div> 
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <img class="img img-fluid mb-2" src="{{asset('assets/img/igoniometer-device.png')}}" alt="Alat IGoniometer" style="height: 200px;">
                            <p class="text-justify">
                                IGoniometer merupakan goniometer digital yang dirancang untuk mengukur sudut gerakan sendi sekaligus memantau aktivitas listrik otot.
                                Dengan teknologi digital, alat ini menawarkan pembacaan yang lebih mudah dan cepat dibandingkan dengan goniometer analog.
                                Biasanya digunakan dalam berbagai bidang seperti kedokteran.
                            </p> 
                        </div>
                    </article>
                </div>
            </div>
        </div>
    @endsection
