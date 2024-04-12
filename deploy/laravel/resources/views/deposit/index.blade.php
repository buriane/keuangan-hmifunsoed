@extends('layout.main')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Uang Deposit</h1>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="mb-3">
            @can('bendahara')
                <div class="d-inline">
                    <button class="btn btn-dark btn-icon-split">
                        <a href="/deposit/create" class="btn btn-dark btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">Tambah</span>
                        </a>
                    </button>
                </div>
            @endcan
            <div class="d-inline">
                <button class="btn btn-info btn-icon-split">
                    <a href="/deposit/history" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-list"></i>
                        </span>
                        <span class="text">Riwayat</span>
                    </a>
                </button>
            </div>
        </div>
    </div>
    {{-- blueprint filter --}}
    {{-- <div class="col-lg-6 col-12">
        <div class="row d-flex justify-content-lg-end">
            <div class="div col-lg-6">
                <form action="" method="get" autocomplete="off" id="search">
                    @csrf
                    <div class="input-group mb-4">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Masukan nama atau divisi">
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
</div>

@can('bendahara')
    @if (session()->has('sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('sukses') }}
        </div>
    @endif
@endcan

<div class="card shadow mb-5">
    <div class="card-header py-3">
        <h6 class="m-0"><i class="fa fa-info-circle" aria-hidden="true"></i> Baca ketentuan Uang Deposit <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#ketentuan">disini.</a></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="container">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Divisi</th>
                        <th colspan="6">Denda</th>
                        <th rowspan="2">Total</th>
                        <th rowspan="2">Sisa Deposit</th>
                    </tr>
                    <tr>
                        <th>Raplen</th>
                        <th>Jahim Day</th>
                        <th>Wisuda</th>
                        <th>Pesek</th>
                        <th>Proker</th>
                        <th>Lainya</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <?php
                        $raplen = $deposit->sum('raplen');
                        $jahim = $deposit->sum('jahim');
                        $wisuda = $deposit->sum('wisuda');
                        $pesek = $deposit->sum('pesek');
                        $proker = $deposit->sum('proker');
                        $lainya = $deposit->sum('lainya');
                        $total = $raplen + $jahim + $wisuda + $pesek + $proker + $lainya;
                    ?>
                    <tr>
                        <th colspan="3">Total</th>
                        <th><script> document.write(ribuan({{ $raplen }})) </script></th>
                        <th><script> document.write(ribuan({{ $jahim }})) </script></th>
                        <th><script> document.write(ribuan({{ $wisuda }})) </script></th>
                        <th><script> document.write(ribuan({{ $pesek }})) </script></th>
                        <th><script> document.write(ribuan({{ $proker }})) </script></th>
                        <th><script> document.write(ribuan({{ $lainya }})) </script></th>
                        <th><script> document.write(ribuan({{ $total }})) </script></th>
                        <th><script> document.write(ribuan({{ (30000 * $deposit->count()) - $total }})) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($deposit as $data)
                        <?php $total = ($data->raplen + $data->jahim + $data->wisuda + $data->pesek + $data->proker + $data->lainya) ?>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->nama }}</td>
                            <td>{{ $data->divisi }}</td>
                            <td><script> document.write(ribuan({{ $data->raplen }})) </script></td>
                            <td><script> document.write(ribuan({{ $data->jahim }})) </script></td>
                            <td><script> document.write(ribuan({{ $data->wisuda }})) </script></td>
                            <td><script> document.write(ribuan({{ $data->pesek }})) </script></td>
                            <td><script> document.write(ribuan({{ $data->proker }})) </script></td>
                            <td><script> document.write(ribuan({{ $data->lainya }})) </script></td>
                            <td><script> document.write(ribuan({{ $total }})) </script></td>
                            <td class="{{ (30000-$total < 0) ? 'text-danger' : '' }}"><script> document.write(ribuan({{ 30000 - $total }})) </script></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ketentuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Ketentuan Uang Deposit</h5>
                <ol style="text-align: justify; text-justify: inter-word;">
                    <li>Penanggung jawab : <a href="http://wa.me/6285219347648" target="blank" class="text-decoration-none">Faizal Amri</a></li>
                    <li>Nominal yang harus dibayarkan sebesar Rp30.000,00 di awal kepengurusan</li>
                    <li>Waktu pembayaran uang deposit dimulai setelah Musyawarah Kerja sampai Rapat Pleno pertama</li>
                    <li>Pembayaran uang deposit dapat dilakukan secara tunai maupun melalui gopay HMIF</li>
                    <li>Melakukan konfirmasi kepada penanggung jawab setelah melakukan pembayaran jika pembayaran uang deposit dilakukan melalui gopay HMIF</li>
                    <li>Jika pengurus melakukan pelanggaran maka akan berlaku pengurangan uang deposit sesuai ketentuan yang berlaku</li>
                    <li>Jika di akhir kepengurusan uang deposit masih tersisa maka akan dikembalikan lagi kepada pengurus yang bersangkutan</li>
                    <li>Rekening gopay HMIF : 0895707839911 A/N HMIF Unsoed atau Faizal Amri</li>
                </ol>
            <div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>                                     
            </div>
        </div>
    </div>
</div>

@endsection