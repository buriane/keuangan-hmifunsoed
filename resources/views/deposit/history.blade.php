@extends('layout.pagination')


@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Riwayat Pengurangan Deposit</h1>

@can('bendahara')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="mb-3">
                <div class="d-inline">
                    <button class="btn btn-dark btn-icon-split">
                        <a data-toggle="modal" data-target="#denda" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa fa-minus"></i>
                            </span>
                            <span class="text">Denda</span>
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
@endcan

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
                        <th>keterangan</th>
                        <th>Nominal</th>
                        @can('bendahara')
                            <th>Aksi</th>
                        @endcan
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
                            <td style="text-align:left ;">{{ $data->deposit->pengurus->nama }}</td>
                            <td>{{ $data->deposit->pengurus->divisi }}</td>
                            <td style="text-align:left ;">{{ $data->keterangan }}</td>
                            <td style="text-align:right ;"><script> document.write(rp({{ $data->nominal }})) </script></td>
                            @can('bendahara')
                                <td>
                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                                </td>
                            @endcan
                        </tr>
                        @can('bendahara')
                            <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pengurangan Deposit</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/deposit/{{ $data->id }}" autocomplete="off">
                                                @csrf
                                                @method('put')
                                                <div class="form-group row">
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <label for="tanggal">Tanggal</label>
                                                        <input type="date" value="{{ $data->tanggal }}" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <label for="dana_id">Nama Pengurus</label>
                                                        <select class="form-control form-control-user" name="deposit_id" id="deposit_id" required>
                                                            @foreach ($divisi as $div)
                                                                <?php
                                                                    $d = DB::table('deposits')
                                                                        ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
                                                                        ->select('*')
                                                                        ->where('penguruses.divisi', '=', $div->divisi)
                                                                        ->get();
                                                                ?>
                                                                <option value="" class="font-weight-bold" disabled>{{ $div->divisi }}</option>
                                                                @foreach ($d as $depo)
                                                                    <option {{ ($data->deposit_id == $depo->id) ? 'selected' : '' }} value="{{ $depo->id }}">{{ $depo->nama }}</option>
                                                                @endforeach
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-7 mb-3 mb-sm-0">
                                                        <label for="keterangan">Keterangan</label>
                                                        <select class="form-control form-control-user" name="keterangan" id="keterangan" required>
                                                            <option {{ ($data->keterangan == 'Tidak mengikuti rapat pleno') ? 'selected' : '' }} value="Tidak mengikuti rapat pleno">Tidak mengikuti rapat pleno</option>
                                                            <option {{ ($data->keterangan == 'Terlambat mengikuti rapat pleno') ? 'selected' : '' }} value="Terlambat mengikuti rapat pleno">Terlambat mengikuti rapat pleno</option>
                                                            <option {{ ($data->keterangan == 'Tidak menggunakan jahim ketika jahim day') ? 'selected' : '' }} value="Tidak menggunakan jahim ketika jahim day">Tidak menggunakan jahim ketika jahim day</option>
                                                            <option {{ ($data->keterangan == 'Tidak mengikuti wisuda offline') ? 'selected' : '' }} value="Tidak mengikuti wisuda offline">Tidak mengikuti wisuda offline</option>
                                                            <option {{ ($data->keterangan == 'Tidak mengikuti piket pesek') ? 'selected' : '' }} value="Tidak mengikuti piket pesek">Tidak mengikuti piket pesek</option>
                                                            <option {{ ($data->keterangan == 'Tidak bertanggung jawab dalam menjalankan proker') ? 'selected' : '' }} value="Tidak bertanggung jawab dalam menjalankan proker">Tidak bertanggung jawab dalam menjalankan proker</option>
                                                            <option {{ ($data->keterangan == 'Lainya') ? 'selected' : '' }} value="Lainya">Lainya</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label for="nominal">Nominal</label>
                                                        <input type="number" value="{{ $data->nominal }}" class="form-control form-control-user" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
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
                                            <form action="/deposit/{{ $data->id }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-primary">Lanjutkan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@can('bendahara')
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

@endsection