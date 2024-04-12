@extends('layout.main')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Uang Deposit</h1>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="mb-3">
            @can('bendahara')
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
                    <button class="btn btn-danger btn-icon-split">
                        <a data-toggle="modal" data-target="#denda" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa fa-minus"></i>
                            </span>
                            <span class="text">Denda</span>
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
            <table class="text-nowrap table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Divisi</th>
                        <th colspan="6">Denda</th>
                        <th rowspan="2">Total</th>
                        <th rowspan="2">Sisa Deposit</th>
                        @can('bendahara')
                            <th rowspan="2">Aksi</th>
                        @endcan
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
                        $sisa = $deposit->sum('sisa');
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
                        <th><script> document.write(ribuan({{ $sisa - $total }})) </script></th>
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
                            <td class="{{ ($data->sisa - $total < 0) ? 'text-danger' : '' }}"><script> document.write(ribuan({{ $data->sisa - $total }})) </script></td>
                            @can('bendahara')
                                <td>
                                    <a href="deposit/manage/{{ $data->id }}" class="btn btn-success btn-sm"><span><i class="fa fa-pencil"></i></span></a>
                                </td>
                            @endcan
                        </tr>
                        <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/deposit/bayar" method="post" autocomplete="off">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pembayaran Deposit</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span>
                                                <input readonly class="form-control" type="text" name="nama" id="nama" value="{{ $data->nama }}">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar-sign"></i></span>
                                                <input required class="form-control" type="number" name="sisa" id="sisa" value="{{ $data->sisa }}" placeholder="Masukkan Nominal">
                                                <input hidden class="form-control" type="text" name="id" id="id" value="{{ $data->id }}">
                                            </div>
                                        <div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary mr-0" type="submit">Simpan</button>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@can('bendahara')
<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran Deposit</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/deposit/bayar" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-8">
                            <label for="dana_id">Nama Pengurus</label>
                            <select class="deposit_id form-control form-control-user" name="deposit_id" id="deposit_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($divisi as $div)
                                    <?php
                                        $d = DB::table('deposits')
                                            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
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
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="dana_id">Media</label>
                            <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($dana as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
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

<div class="modal fade" id="denda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengurangan Deposit</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/deposit" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-8">
                            <label for="dana_id">Nama Pengurus</label>
                            <select class="deposit_id form-control form-control-user" name="deposit_id" id="deposit_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($divisi as $div)
                                    <?php
                                        $d = DB::table('deposits')
                                            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
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
                            <label for="keterangan">Keterangan</label>
                            <select class="form-control form-control-user" name="keterangan" id="keterangan" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="Tidak mengikuti rapat pleno">Tidak mengikuti rapat pleno</option>
                                <option value="Terlambat mengikuti rapat pleno">Terlambat mengikuti rapat pleno</option>
                                <option value="Tidak menggunakan jahim ketika jahim day">Tidak menggunakan jahim ketika jahim day</option>
                                <option value="Tidak mengikuti wisuda offline">Tidak mengikuti wisuda offline</option>
                                <option value="Tidak mengikuti piket pesek">Tidak mengikuti piket pesek</option>
                                <option value="Tidak bertanggung jawab dalam menjalankan proker">Tidak bertanggung jawab dalam menjalankan proker</option>
                                <option value="Lainya">Lainya</option>
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
                <h5 class="text-center">Ketentuan Uang Deposit</h5>
                <ol style="text-align: justify; text-justify: inter-word;">
                    <li>Penanggung jawab : <a href="http://wa.me/6282115732050" target="blank" class="text-decoration-none">Nurul Afifah</a></li>
                    <li>Nominal yang harus dibayarkan sebesar Rp30.000,00</li>
                    <li>Pembayaran uang deposit dapat dilakukan secara tunai maupun melalui e-wallet HMIF</li>
                    <li>Melakukan konfirmasi kepada penanggung jawab setelah melakukan pembayaran jika pembayaran uang deposit dilakukan melalui e-wallet HMIF</li>
                    <li>Jika pengurus melakukan pelanggaran maka akan berlaku pengurangan uang deposit sesuai ketentuan yang berlaku</li>
                    <li>Jika di akhir kepengurusan uang deposit masih tersisa maka akan dikembalikan lagi kepada pengurus yang bersangkutan</li>
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