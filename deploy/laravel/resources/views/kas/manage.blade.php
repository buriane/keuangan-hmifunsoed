@extends('layout.main')


@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Data Pembayaran Uang Kas</h1>

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
@if (session()->has('peringatan'))
    <div class="alert alert-warning" role="alert">
        {{ session('peringatan') }}
    </div>
@endif

<div class="card shadow mb-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Menampilkan hasil untuk : </h6>
        <table>
            <tr>
                <td>Nama</td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{ $identitas->nama }}</td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{ $identitas->divisi }}</td>
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
                        <th>Bulan</th>
                        <th>Media</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center" colspan="3">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp({{ $history->sum('nominal') }})) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($history as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td style="text-align:left ;">{{ $data->bulan }}</td>
                            <td style="text-align:left ;">{{ $data->dana->nama }}</td>
                            <td style="text-align:right ;"><script> document.write(rp({{ $data->nominal }})) </script></td>
                            <td>
                                <a href="/kas/{{ $data->id }}/edit" class="btn btn-success btn-sm"><span><i class="fa fa-pencil"></i></span></a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="hapus-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Apakah anda yakin? Tekan tombol lanjutkan untuk menghapus data.</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <form action="/kas/{{ $data->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-primary">Lanjutkan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection