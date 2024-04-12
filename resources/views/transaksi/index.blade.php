@extends('layout.pagination')


@section('content')
<?php use App\Models\Kreus; ?> 
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Riwayat Transaksi</h1>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="mb-3">
            <div class="d-inline">
                <button class="btn btn-dark btn-icon-split">
                    <a data-toggle="modal" data-target="#tambah" class="btn btn-dark btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
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
                        <th>keterangan</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($transaksi as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td style="text-align:left ;">{{ $data->detail }}</td>
                            <td style="text-align:left ;">{{ $data->dana->nama }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td style='text-align:right ;'><script> document.write(rp({{ $data->nominal }})) </script></td>
                            @if($data->detail == 'Kas HMIF')
                                <td>
                                    <a href="/kas" class="btn btn-success btn-sm"><span><i class="fa fa-pencil"></i></span></a>
                                </td>
                            @elseif($data->detail == 'Uang Deposit')
                                <td>
                                    <a href="/deposit" class="btn btn-success btn-sm"><span><i class="fa fa-pencil"></i></span></a>
                                </td>
                            @else
                                <td>
                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                                </td>
                            @endif
                        </tr>
                        <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Perbarui Transaksi</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/transaksi/{{ $data->id }}" autocomplete="off">
                                            @csrf
                                            @method('put')
                                            <div class="form-group row">
                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="date" class="form-control form-control-user" value="{{ $data->tanggal }}" id="tanggal" name="tanggal" required>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="keterangan">Keterangan</label>
                                                    <select class="form-control form-control-user" name="keterangan" id="keterangan" required>
                                                        <option {{ ($data->keterangan == 'Pemasukan') ? 'selected' : '' }} value="Pemasukan">Pemasukan</option>
                                                        <option {{ ($data->keterangan == 'Pengeluaran') ? 'selected' : '' }} value="Pengeluaran">Pengeluaran</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="detail">Detail data</label>
                                                <input type="text" class="form-control form-control-user" value="{{ $data->detail }}" id="detail" name="detail" placeholder="Masukkan Detail Transaksi" required>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-7 mb-3 mb-sm-0">
                                                    <label for="dana_id">Sumber Dana</label>
                                                    <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                                        @foreach ($dana as $dn)
                                                            <option {{ ($data->dana->nama == $dn->nama) ? 'selected' : '' }} value="{{ $dn->id }}">{{ $dn->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="nominal">Nominal</label>
                                                    <input type="number" class="form-control form-control-user" value="{{ $data->nominal }}" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
                                                </div>
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
                                        <form action="/transaksi/{{ $data->id }}" method="post">
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

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/transaksi" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-8">
                            <label for="keterangan">Keterangan</label>
                            <select class="form-control form-control-user" name="keterangan" id="keterangan" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail">Detail Transaksi</label>
                        <input type="text" class="form-control form-control-user" id="detail" name="detail" placeholder="Masukkan Detail Transaksi" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="dana_id">Sumber Dana</label>
                            <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($dana as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="nominal">Nominal</label>
                            <input type="number" class="form-control form-control-user" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
                        </div>
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

@endsection