@extends('layout.add')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Uang Kas</h1>

@can('bendahara')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="mb-3">
                <div class="d-inline">
                    <button class="btn btn-success btn-icon-split">
                        <a data-toggle="modal" data-target="#bayar" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">Bayar</span>
                        </a>
                    </button>
                </div>
                <div class="d-inline">
                    <button class="btn btn-info btn-icon-split">
                        <a href="/kas/history" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa fa-list"></i>
                            </span>
                            <span class="text">Riwayat</span>
                        </a>
                    </button>
                </div>
            </div>
        </div>
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
    @if (session()->has('peringatan'))
        <div class="alert alert-warning" role="alert">
            {{ session('peringatan') }}
        </div>
    @endif
@endcan

@if (session()->has('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0"><i class="fa fa-info-circle" aria-hidden="true"></i> Baca ketentuan Uang Kas <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#ketentuan">disini.</a></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="text-nowrap table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Divisi</th>
                        <th colspan="8">Bulan</th>
                        @can('bendahara')
                            <th rowspan="2">Aksi</th>
                        @endcan
                    </tr>
                    <tr>
                        <th>April</th>
                        <th>Mei</th>
                        <th>Juni</th>
                        <th>Juli</th>
                        <th>Agustus</th>
                        <th>September</th>
                        <th>Oktober</th>
                        <th>Novenber</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="3">Jumlah</th>
                        <th>{{ $kas->where('april', '>', 0)->count() }}</th>
                        <th>{{ $kas->where('mei', '>', 0)->count() }}</th>
                        <th>{{ $kas->where('juni', '>', 0)->count() }}</th>
                        <th>{{ $kas->where('juli', '>', 0)->count() }}</th>
                        <th>{{ $kas->where('agustus', '>', 0)->count() }}</th>
                        <th>{{ $kas->where('september', '>', 0)->count() }}</th>
                        <th>{{ $kas->where('oktober', '>', 0)->count() }}</th>
                        <th>{{ $kas->where('november', '>', 0)->count() }}</th>
                    </tr>
                    <tr>
                        <th colspan="3" rowspan="2" style="vertical-align:middle ;">Total Dana</th>
                        <th><script> document.write(ribuan( {{ $totalApril }} )) </script></th>
                        <th><script> document.write(ribuan( {{ $totalMei }} )) </script></th>
                        <th><script> document.write(ribuan( {{ $totalJuni }} )) </script></th>
                        <th><script> document.write(ribuan( {{ $totalJuli }} )) </script></th>
                        <th><script> document.write(ribuan( {{ $totalAgustus }} )) </script></th>
                        <th><script> document.write(ribuan( {{ $totalSeptember }} )) </script></th>
                        <th><script> document.write(ribuan( {{ $totalOktober }} )) </script></th>
                        <th><script> document.write(ribuan( {{ $totalNovember }} )) </script></th>
                    </tr>
                    <tr>
                        <th colspan="8">Rp<script> document.write(ribuan( {{ $totalApril + $totalMei + $totalJuni + $totalJuli + $totalAgustus + $totalSeptember + $totalOktober + $totalNovember }} )) </script>,00</th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($kas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->nama }}</td>
                            <td>{{ $data->divisi }}</td>
                            <td><?php
                                if ($data->april > 0) {
                                    echo "<script> document.write(ribuan($data->april)) </script>";
                                } else {
                                    echo "-";
                                }
                                ?></td>
                            <td>   
                                <?php
                                if ($data->mei > 0) {
                                    echo "<script> document.write(ribuan($data->mei)) </script>";
                                } else {
                                    echo "-";
                                }
                                ?>
                            </td>
                            <td><?php
                                if ($data->juni > 0) {
                                    echo "<script> document.write(ribuan($data->juni)) </script>";
                                } else {
                                    echo "-";
                                }
                                ?></td>
                            <td><?php
                                if ($data->juli > 0) {
                                    echo "<script> document.write(ribuan($data->juli)) </script>";
                                } else {
                                    echo "-";
                                }
                                ?></td>
                            <td><?php
                                if ($data->agustus > 0) {
                                    echo "<script> document.write(ribuan($data->agustus)) </script>";
                                } else {
                                    echo "-";
                                }
                                ?></td>
                            <td><?php
                                if ($data->september > 0) {
                                    echo "<script> document.write(ribuan($data->september)) </script>";
                                } else {
                                    echo "-";
                                }
                                ?></td>
                            <td><?php
                                if ($data->oktober > 0) {
                                    echo "<script> document.write(ribuan($data->oktober)) </script>";
                                } else {
                                    echo "-";
                                }
                                ?></td>
                            <td><?php
                                if ($data->november > 0) {
                                    echo "<script> document.write(ribuan($data->november)) </script>";
                                } else {
                                    echo "-";
                                }
                                ?></td>
                            @can('bendahara')
                                <td>
                                    <a href="/kas/manage/{{ $data->id }}" class="btn btn-success btn-sm"><span><i class="fa fa-pencil"></i></span></a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@can('bendahara')
<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran Kas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/kas" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="dana_id">Media</label>
                            <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($dana as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="dana_id">Nama Pengurus</label>
                            <select class="deposit_id form-control form-control-user" name="kas_id" id="kas_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($divisi as $div)
                                    <?php
                                        $d = DB::table('kas')
                                            ->join('penguruses', 'kas.pengurus_id', '=', 'penguruses.id')
                                            ->select('*')
                                            ->where('penguruses.divisi', '=', $div->divisi)
                                            ->get();
                                    ?>
                                    <option value="" class="font-weight-bold" disabled>{{ $div->divisi }}</option>
                                    @foreach ($d as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="bulan">Bulan</label>
                            <select class="form-control form-control-user" name="bulan-1" id="bulan-1" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="nominal">Denda</label>
                            <select class="form-control form-control-user" name="nominal-1" id="nominal-1" required>
                                <option selected value="15000">Tidak</option>
                                <option value="17000">2.000</option>
                                <option value="19000">4.000</option>
                                <option value="21000">6.000</option>
                                <option value="23000">8.000</option>
                                <option value="25000">10.000</option>
                                <option value="27000">12.000</option>
                                <option value="29000">14.000</option>
                                <option value="31000">16.000</option>
                                <option value="33000">18.000</option>
                            </select>
                        </div>
                    </div>
                    <div id='setB'></div>
                    <div id="up" class="form-group text-center mt-4">
                        <a href="#up" class="DEL btn btn-danger">x</a>
                        <a href="#up" id="ADD" class="btn btn-secondary">+</a>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endcan

<div class="modal fade" id="ketentuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content pr-4">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Ketentuan Uang Kas</h5>
                <ol style="text-align: justify; text-justify: inter-word;">
                    <li>Penanggung jawab : <a href="http://wa.me/6285715498968" target="blank" class="text-decoration-none">Melyana Rizky Ramadhani</a></li>
                    <li>Timeline pelaksanaan : April 2023 - November 2023</li>
                    <li>Nominal yang harus dibayarkan sebesar Rp15.000,00 setiap bulanya</li>
                    <li>Pembayaran uang kas dapat dilakukan secara tunai maupun melalui e-wallet HMIF</li>
                    <li>Melakukan konfirmasi kepada penanggung jawab setelah melakukan pembayaran jika pembayaran uang kas dilakukan melalui e-wallet HMIF</li>
                    <li>Dapat membayar sekaligus untuk bulan-bulan berikutnya</li>
                    <li>Batas pembayaran setiap akhir bulan</li>
                    <li>Jika pengurus terlambat membayar uang kas maka akan dikenakan sanksi sesuai ketentuan yang berlaku</li>
                    <li>Rekening DANA HMIF : 085880480807 A/N Athiyya Adzky Khairanyi</li>
                </ol>
            <div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>                                     
            </div>
        </div>
    </div>
</div>

@endsection