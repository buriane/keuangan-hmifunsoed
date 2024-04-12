@extends('layout.pagination')


@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Riwayat Pembayaran Uang Kas</h1>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="mb-3">
            <div class="d-inline">
                <button class="btn btn-dark btn-icon-split">
                    <a href="/kas/create" class="btn btn-dark btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </button>
            </div>
        </div>
    </div>
</div>

@if (session()->has('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
@endif

<div class="card shadow mb-5">
    <div class="card-body">
        <div class="table-responsive">
            <table class="text-nowrap table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Bulan</th>
                        <th>Media</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center" colspan="5">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp({{ $history->sum('nominal') }})) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($history as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td style="text-align:left ;">{{ $data->kas->pengurus->nama }}</td>
                            <td>{{ $data->kas->pengurus->divisi }}</td>
                            <td style="text-align:left ;">{{ $data->bulan }}</td>
                            <td style="text-align:left ;">{{ $data->dana->nama }}</td>
                            <td style="text-align:right ;"><script> document.write(rp({{ $data->nominal }})) </script></td>
                            <td>
                                <a href="/kas/manage/{{ $data->kas_id }}" class="btn btn-success btn-sm"><span><i class="fa fa-pencil"></i></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection