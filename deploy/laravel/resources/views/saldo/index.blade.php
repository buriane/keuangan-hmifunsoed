@extends('layout.main')


@section('content')
<?php use App\Kreus; ?> 
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Rekapitulasi Saldo {{ $judul }}</h1>

<div class="col-12">
    <div class="div">
        <form action="" method="get" role="form">
            @csrf
            <div class="form-group">
                <div class="row justify-content-lg-end d-flex">
                    <div class="col-5 col-lg-2 col-md-4">
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

<div class="card shadow mb-5">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Sumber Dana</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="2">Total</th>
                        <th style='text-align:right ;'><script> document.write(rp( {{ $total['masuk'] }} )) </script></th>
                        <th style='text-align:right ;'><script> document.write(rp( {{ $total['keluar'] }} )) </script></th>
                        <th style='text-align:right ;'><script> document.write(rp( {{ $total['masuk'] - $total['keluar'] }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($dana as $data)
                    <?php
                        $masuk = $transaksi->where('dana_id', $data->id)->where('keterangan', 'Pemasukan')->sum('nominal');
                        $keluar = $transaksi->where('dana_id', $data->id)->where('keterangan', 'Pengeluaran')->sum('nominal');
                    ?>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->nama }}</td>
                            <td style='text-align:right ;'><script> document.write(rp( {{ $masuk }} )) </script></td>
                            <td style='text-align:right ;'><script> document.write(rp( {{ $keluar }} )) </script></td>
                            <td style='text-align:right ;'><script> document.write(rp( {{ $masuk - $keluar }} )) </script></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection