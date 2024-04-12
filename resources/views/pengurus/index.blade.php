@extends('layout.add')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Pengurus HMIF</h1>

@can('bendahara')
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
@endcan

@if (session()->has('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="text-nowrap table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($pengurus as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->nama }}</td>
                            <td>{{ $data->divisi }}</td>
                            <td>
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                            </td>
                            <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengurus</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/pengurus/{{ $data->id }}" autocomplete="off">
                                                @csrf
                                                @method('put')
                                                <div class="form-group row">
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        Divisi
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <select class="form-control form-control-user" name="divisi" id="divisi" required>
                                                            <option value="" selected hidden>Pilih</option>
                                                            <option {{ ($data->divisi == 'BPH') ? 'selected' : '' }} value="BPH">Badan Pengurus Harian</option>
                                                            <option {{ ($data->divisi == 'EDUKASI') ? 'selected' : '' }} value="EDUKASI">Edukasi</option>
                                                            <option {{ ($data->divisi == 'ILTEK') ? 'selected' : '' }} value="ILTEK">Keilmuan dan Teknologi</option>
                                                            <option {{ ($data->divisi == 'HUMAS') ? 'selected' : '' }} value="HUMAS">Hubungan Masyarakat</option>
                                                            <option {{ ($data->divisi == 'KREUS') ? 'selected' : '' }} value="KREUS">Kreasi dan Usaha</option>
                                                            <option {{ ($data->divisi == 'MEDKOM') ? 'selected' : '' }} value="MEDKOM">Media Komunikasi dan Informasi</option>
                                                            <option {{ ($data->divisi == 'MIKAT') ? 'selected' : '' }} value="MIKAT">Minat dan Bakat</option>
                                                            <option {{ ($data->divisi == 'PSDM') ? 'selected' : '' }} value="PSDM">Pengembangan Sumber Daya Mahasiswa</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        Nama
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input value="{{ $data->nama }}" type="text" name="nama" id="nama" required class="form-control form-control-user" placeholder="Masukkan Nama Pengurus">
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input hidden type="text" name="id" id="id" value="{{ $data->id }}">
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
                                            <form action="/pengurus/{{ $data->id }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <input hidden type="text" name="id" id="id" value="{{ $data->id }}">
                                                <button class="btn btn-primary">Lanjutkan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengurus</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/pengurus" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            Divisi
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control form-control-user" name="divisi" id="divisi" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="BPH">Badan Pengurus Harian</option>
                                <option value="EDUKASI">Edukasi</option>
                                <option value="ILTEK">Keilmuan dan Teknologi</option>
                                <option value="HUMAS">Hubungan Masyarakat</option>
                                <option value="KREUS">Kreasi dan Usaha</option>
                                <option value="MEDKOM">Media Komunikasi dan Informasi</option>
                                <option value="MIKAT">Minat dan Bakat</option>
                                <option value="PSDM">Pengembangan Sumber Daya Mahasiswa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            Nama
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="nama-1" id="nama-1" required class="form-control form-control-user" placeholder="Masukkan Nama Pengurus">
                        </div>
                    </div>
                    <div id='setB-2'></div>
                    <div id="up" class="form-group text-center mt-4">
                        <a href="#up" class="DEL-2 btn btn-danger">x</a>
                        <a href="#up" id="ADD-2" class="btn btn-secondary">+</a>
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