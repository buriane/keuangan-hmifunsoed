@extends('layout.main')


@section('content')
<?php use App\Kreus; ?> 
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Edit Laporan Keuangan Kreus {{ $judul }}</h1>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="mb-3">
            <div class="dropdown no-arrow d-inline">
                <button class="btn btn-dark btn-icon-split dropdown-toggle" type="button"
                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Tambah</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/laporan-kreus/create/1">Pemasukan</a>
                    <a class="dropdown-item" href="/laporan-kreus/create/2">Pengeluaran Kreus</a>
                    <a class="dropdown-item" href="/laporan-kreus/create/3">Pengeluaran diluar Kreus</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12">
        <div class="div">
            <form action="" method="get" role="form">
                @csrf
                <div class="form-group">
                    <div class="row justify-content-lg-end d-flex">
                        <div class="col-5 col-lg-6 col-md-4">
                            <select id="bln" name="bln" type="text" class="form-control">
                                <option hidden selected value="">Pilih Bulan</option>
                                @foreach ($bln as $data)
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

<h2 class="h4 mb-3 text-gray-800">Pemasukan</h2>
<div class="card shadow mb-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pemasukan Divisi Kreasi dan Usaha</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Program Kerja</th>
                        <th>Sumber Dana</th>
                        <th>Penanggung Jawab</th>
                        <th>Pemasukan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="4">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->where('kategori', 'Pemasukan')->sum('pemasukan') }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($laporan->where('kategori', 'Pemasukan') as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->proker }}</td>
                            <td style="text-align:left ;">{{ $data->sumber }}</td>
                            <td style="text-align:left ;">{{ $data->pj }}</td>
                            <td style="text-align:right ;"><script> document.write(rp( {{ $data->pemasukan }} )) </script></td>
                            <td>
                                <a href="/laporan-kreus/{{ $data->id }}/edit" class="btn btn-success btn-sm"><span><i class="fa fa-pencil"></i></span></a>
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
                                        <form action="/laporan-kreus/{{ $data->id }}" method="post">
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

<h2 class="h4 mb-3 text-gray-800">Pengeluaran</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <ol class="mb-0">
                <li>Pengeluaran Dana untuk Program Kerja Divisi Kreasi dan Usaha</li>
            </ol>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Program Kerja</th>
                        <th>Keterangan</th>
                        <th>Penanggung Jawab</th>
                        <th>Pengeluaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="4">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->where('kategori', 'Pengeluaran Kreus')->sum('pengeluaran') }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($laporan->where('kategori', 'Pengeluaran Kreus') as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->proker }}</td>
                            <td style="text-align:left ;">{{ $data->keterangan }}</td>
                            <td style="text-align:left ;">{{ $data->pj }}</td>
                            <td style="text-align:right ;"><script> document.write(rp( {{ $data->pengeluaran }} )) </script></td>
                            <td>
                                <a href="/laporan-kreus/{{ $data->id }}/edit" class="btn btn-success btn-sm"><span><i class="fa fa-pencil"></i></span></a>
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
                                        <form action="/laporan-kreus/{{ $data->id }}" method="post">
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
<div class="card shadow mb-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <ol start="2" class="mb-0">
                <li>Pengeluaran Dana untuk Program Kerja diluar Divisi Kreasi dan Usaha</li>
            </ol>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Program Kerja</th>
                        <th>Pengeluaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="3">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->where('kategori', 'Pengeluaran diluar Kreus')->sum('pengeluaran') }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($laporan->where('kategori', 'Pengeluaran diluar Kreus') as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->tanggal }}</td>
                            <td style="text-align:left ;">{{ $data->proker }}</td>
                            <td style="text-align:right ;"><script> document.write(rp( {{ $data->pengeluaran }} )) </script></td>
                            <td>
                                <a href="/laporan-kreus/{{ $data->id }}/edit" class="btn btn-success btn-sm"><span><i class="fa fa-pencil"></i></span></a>
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
                                        <form action="/laporan-kreus/{{ $data->id }}" method="post">
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

<h2 class="h4 mb-3 text-gray-800">Rekapitulasi</h2>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="2">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->sum('pemasukan') }} )) </script></th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->sum('pengeluaran') }} )) </script></th>
                    </tr>
                    <tr>
                        <th colspan="2">Saldo</th>
                        <th colspan="2"><script> document.write(rp( {{ $laporan->sum('pemasukan') - $laporan->sum('pengeluaran') }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($laporan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->proker }} {{ ($data->keterangan != null) ? '- '.$data->keterangan : '' }}</td>
                            @if ($data->pemasukan)
                                <td style='text-align:right ;'><script> document.write(rp({{ $data->pemasukan }})) </script></td>
                                <td style='text-align:right ;'>-</td>
                            @else
                                <td style='text-align:right ;'>-</td>
                                <td style='text-align:right ;'><script> document.write(rp({{ $data->pengeluaran }})) </script></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection