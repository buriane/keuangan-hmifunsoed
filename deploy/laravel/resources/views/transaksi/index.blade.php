@extends('layout.pagination')


@section('content')
<?php use App\Kreus; ?> 
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Riwayat Transaksi</h1>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="mb-3">
            <div class="d-inline">
                <button class="btn btn-dark btn-icon-split">
                    <a href="/transaksi/create" class="btn btn-dark btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </button>
            </div>
            <div class="d-inline">
                <button class="btn btn-danger btn-icon-split">
                    <a href="/transaksi/manage" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-pencil-square-o"></i>
                        </span>
                        <span class="text">Edit</span>
                    </a>
                </button>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12">
        <div class="div">
            <form action="" method="get" role="form">
                @csrf
                <div class="form-group">
                    <div class="row justify-content-lg-end d-flex">
                        <div class="col-4 col-lg-4 col-md-4">
                            <select id="dana" name="dana" type="text" class="form-control">
                                <option hidden selected value="">Sumber Dana</option>
                                @foreach ($dana as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 col-lg-4 col-md-4">
                            <select id="bulan" name="bulan" type="text" class="form-control">
                                <option hidden selected value="">Bulan</option>
                                @foreach ($bulan as $data)
                                    <option value="{{ $data->bulan }}">{{ Kreus::bulan($data->bulan) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session()->has('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
@endif

<div class="card shadow mb-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Menampilkan hasil untuk : </h6>
        <table>
            <tr>
                <td>Bulan</td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{ (isset($_GET['bulan'])) ? Kreus::bulan($_GET['bulan']) : 'Semua' }}</td>
            </tr>
            <tr>
                <td>Sumber Dana</td>
                <td>&nbsp;:&nbsp;</td>
                <td>
                    <?php 
                        if(isset($_GET['dana'])) {
                            $display = 'Semua';
                            foreach ($dana as $data) {
                                if ($data->id == $_GET['dana']){
                                    $display = $data->nama;
                                }
                            }
                            echo $display;
                        } else {
                            echo "Semua";
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Detail Transaksi</th>
                        <th>Sumber Dana</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="4">Total</th>
                        <th style='text-align:right ;'><script> document.write(rp( {{ $transaksi->where('keterangan', 'Pemasukan')->sum('nominal') }} )) </script></th>
                        <th style='text-align:right ;'><script> document.write(rp( {{ $transaksi->where('keterangan', 'Pengeluaran')->sum('nominal') }} )) </script></th>
                    </tr>
                    <tr>
                        <th colspan="4">Saldo</th>
                        <th colspan="2"><script> document.write(rp( {{ $transaksi->where('keterangan', 'Pemasukan')->sum('nominal') - $transaksi->where('keterangan', 'Pengeluaran')->sum('nominal') }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($transaksi as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td style="text-align:left ;">{{ $data->detail }}</td>
                            <td style="text-align:left ;">{{ $data->dana->nama }}</td>
                            <?php
                                if ($data->keterangan == 'Pemasukan') {
                                    echo "<td style='text-align:right ;'><script> document.write(rp($data->nominal)) </script></td>";
                                    echo "<td style='text-align:right ;'>-</td>";
                                } else {
                                    echo "<td style='text-align:right ;'>-</td>";
                                    echo "<td style='text-align:right ;'><script> document.write(rp($data->nominal)) </script></td>";
                                }
                            ?>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection